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

        Log::info('userId', ['userId' => $email]);
        $user = User::where('email', $email)->first();
        $appointments = User::with('appointments')->find($user->id);
        // $user = User::find($email);
        Log::info('appointments', ['appointments' => $appointments]);
        $date = Carbon::parse($appointments->date)->locale('ru')->translatedFormat('j F Y');
        $time = Carbon::parse($appointments->time)->locale('ru')->translatedFormat('H:i');
        $this->dateUserFormat = $date;
        $this->timeUserFormat = $time;
        $this->userName = $user->name;
    }

    public function build()
    {
        return $this
            ->subject('Запланированное сообщение')
            ->view('mail.user.scheduled_email');
        // ->with(['messageContent' => $this->messageContent]);
    }
    // public function content(): Content
    // {
    //     return new Content(
    //         markdown: 'mail.user.send',
    //     );
    // }
    // public function content(): Content
    // {
    //     return new Content(
    //         markdown: 'mail.user.send',
    //     );
    // }
}
