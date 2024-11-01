<?php

namespace App\Mail;


use Illuminate\Mail\Mailable;

use App\Models\User;
use App\Models\Questionnaire;
use Carbon\Carbon;
use Log;
class ScheduledEmail extends Mailable
{

    public $dateUserFormat;
    public $timeUserFormat;

    public $userName;
    public function __construct($email)
    {
        Log::info('email ' . $email);
        
        // Получаем пользователя с анкеты
        Log::info('Start find user ');
        $user = User::whereHas('questionnaire', function ($query) use ($email) {
            $query->where('email', $email);
        })->with('questionnaire')->first();

        // Проверка, найден ли пользователь
        if (!$user) {
            Log::error('User not found for email: ' . $email);
            throw new \Exception('User not found'); // Или обработка ошибки
        }
        

    
        // Проверка, есть ли анкета
        $questionnaire = $user->questionnaire;
        if (!$questionnaire) {
            Log::error('Questionnaire not found for user: ' . $user->id);
            throw new \Exception('Questionnaire not found'); // Или обработка ошибки
        }
    
        Log::info('questionnaire ' . $questionnaire);
    
        // Получаем назначения пользователя
        $appointments = $user->appointments; // Используем уже загруженные данные
        if ($appointments->isEmpty()) {
            Log::info('No appointments found for user: ' . $user->id);
            // Обработка отсутствия назначений, если необходимо
        } else {
            Log::info('APPOINTMENTS ' . $appointments);
            
            // Предполагается, что у вас есть хотя бы одна запись назначений
            $date = Carbon::parse($appointments->first()->date)->locale('ru')->translatedFormat('j F Y');
            $time = Carbon::parse($appointments->first()->time)->locale('ru')->addHours(1)->translatedFormat('H:i');
            
            $this->dateUserFormat = $date;
            $this->timeUserFormat = $time;
            $this->userName = $questionnaire->name;
        }
    }

    public function build()
    {
        return $this
        
            ->subject('Ваша ссылка на встречу MathPad через 1 час')
            ->view('mail.user.scheduled_email');

    }
}
