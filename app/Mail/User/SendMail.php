<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use Log;
class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $date;
    public $time;

    public $userName;
    /**
     * Create a new message instance.
     */
    public function __construct($request, $name)
    {
        $dateFormat = date('d.m.Y', strtotime($request->date));
        $dateCarbonFormat = Carbon::createFromFormat('d.m.Y', $dateFormat)->locale('ru')->translatedFormat('j F Y');
        $this->date = $dateCarbonFormat;
        $this->time = $request->time;
        $this->userName = $name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Math Pad Team',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.user.send',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
