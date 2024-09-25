<?php

namespace App\Mail;


use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
// use Illuminate\Mail\Mailables\Content;


namespace App\Mail;

use Illuminate\Mail\Mailable;

class ScheduledEmail extends Mailable
{
    public function __construct()
    {

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
