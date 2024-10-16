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
    public function __construct ($email)
    {

        $user = User::with('questionnaire')->where('email', $email)->first();

        $questionnaire = $user->questionnaire;

        $appointments = User::with('appointments')->find($user->id);

        $date = Carbon::parse($appointments->date)->locale('ru')->translatedFormat('j F Y');
        $time = Carbon::parse($appointments->time)->locale('ru')->addHour()->translatedFormat('H:i');
        $this->dateUserFormat = $date;
        $this->timeUserFormat = $time;
        $this->userName = $questionnaire->name;


        

    }

    public function build()
    {
        return $this
        
            ->subject('Ваша ссылка на встречу MathPad через 1 час')
            ->view('mail.user.scheduled_email');

    }
}
