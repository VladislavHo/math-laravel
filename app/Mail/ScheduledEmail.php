<?php

namespace App\Mail;


use Illuminate\Mail\Mailable;

use App\Models\User;
use Carbon\Carbon;
use Log;
class ScheduledEmail extends Mailable
{

    public $dateUserFormat;
    public $timeUserFormat;

    public $userName;
    public function __construct ($email)
    {

        $user = User::where('email', $email)->first();
        $appointments = User::with('appointments')->find($user->id);
        // $user = User::find($email);

        $date = Carbon::parse($appointments->date)->locale('ru')->translatedFormat('j F Y');
        $time = Carbon::parse($appointments->time)->locale('ru')->addHour()->translatedFormat('H:i');
        $this->dateUserFormat = $date;
        $this->timeUserFormat = $time;
        $this->userName = $user->name;


        

    }

    public function build()
    {
        return $this
        
            ->subject('Запланированное сообщение')
            ->view('mail.user.scheduled_email');

    }
}
