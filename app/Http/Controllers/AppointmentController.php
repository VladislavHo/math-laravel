<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\ScheduledEmailModel;
use App\Models\User;
use Illuminate\Http\Request;
use Log;
use Carbon\Carbon;
use App\Mail\User\SendMail;
use Mail;
class AppointmentController
{
  protected $telegramController;



  public function index()
  {

    $appointments = Appointment::all();

    return response()->json([
      'data' => $appointments,
      'status' => '200',
    ]);
  }

  public function create(Request $request)
  {
      // Проверка существования пользователя
      // $telegramController = new TelegramController();
      $user = User::find($request->id);
      if (!$user) {
          return response()->json(['error' => 'User not found'], 404);
      }
  

      $name = $user->name;
      // Установка временной зоны и даты
      $date = Carbon::parse($request->date)->setTimezone('Europe/Moscow');
  
      // Форматирование времени
      $timeCarbon = Carbon::createFromFormat('H:i', $request->time)->subHour();
      $sendAt = $date->copy()->setTime($timeCarbon->hour, $timeCarbon->minute)->subHours(1)->toDateTimeString();
  
      $scheduleEmail = new ScheduledEmailModel();
      $scheduleEmail->recipient = $user->email;
      $scheduleEmail->message = 'Message';
      // $scheduleEmail->send_at = Carbon::parse($sendAt)->toDateTimeString();
      $scheduleEmail->send_at = Carbon::now()->addMinutes(1)->toDateTimeString();
      $scheduleEmail->save();
  
      try {
          Mail::to($user->email)->send(new SendMail($request,  $name));
      } catch (\Exception $e) {
          return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
      }
  
      // Создание записи о встрече
      $appointment = Appointment::create([
          'date' => $date,
          'time' => $request->time,
          'user_id' => $user->id //
      ]);
  
      User::where('id', $user->id)->update(['send_at' => $sendAt]);


      $appointment->user()->associate($user);
      $appointment->save();
  
      return response()->json([
          'data' => $appointment,
          'status' => '200',
      ]);
  }

  public function storeDates()
  {
    $appointmentDates = Appointment::all()->pluck('date');

    Log::info('appointmentDates', ['dates' => $appointmentDates]);

    return response()->json([
      'dates' => $appointmentDates,
      'status' => '200',
    ]);
  }



}