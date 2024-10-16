<?php

namespace App\Http\Controllers;
use App\Mail\Admin\SendNewOrder;
use App\Models\Analytics;
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
    // Валидация входящих данных
    $request->validate([
      'date' => 'required|date',
      'time' => 'required|string',
    ]);

    // Получение пользователя с опросом
    $user = User::with('questionnaire')->where('id', $request->id)->first();

    if (!$user) {
      return response()->json(['error' => 'User not found'], 404);
    }

    $questionnaire = $user->questionnaire;

    if (!$questionnaire) {
      return response()->json(['error' => 'Questionnaire not found'], 404);
    }

    Log::info('Creating appointment for user', ['user_id' => $user->id]);

    // Установка временной зоны и даты
    $date = Carbon::parse($request->date)->setTimezone('Europe/Moscow');
    $timeCarbon = Carbon::createFromFormat('H:i', $request->time);

    if (!$timeCarbon) {
      return response()->json(['error' => 'Invalid time format'], 400);
    }

    $sendAt = $date->copy()->setTime($timeCarbon->hour, $timeCarbon->minute)->toDateTimeString();

    // Создание записи о запланированном письме
    $scheduleEmail = new ScheduledEmailModel();
    $scheduleEmail->recipient = $questionnaire->email;
    $scheduleEmail->message = 'Message';
    $scheduleEmail->send_at = $sendAt;
    $scheduleEmail->save();




    try {
      Mail::to($questionnaire->email)->send(new SendMail($request, $questionnaire->name, $sendAt));
      Mail::to(env('MAIL_USERNAME'))->send(new SendNewOrder($request, $questionnaire ));
    } catch (\Exception $e) {
      return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
    }

    // Создание записи о встрече
    $appointment = Appointment::create([
      'date' => $date,
      'time' => $request->time,
      'user_id' => $user->id,
    ]);

    // Обновление поля send_at
    $user->update(['send_at' => $sendAt]);

    $user->analytics()->update([
      'is_calendar_passed' => true
    ]);

    return response()->json([
      'data' => $appointment,
      'status' => '200',
    ]);
  }

  public function storeDates()
  {
    $appointmentDates = Appointment::all()->pluck('date');


    return response()->json([
      'dates' => $appointmentDates,
      'status' => '200',
    ]);
  }



}