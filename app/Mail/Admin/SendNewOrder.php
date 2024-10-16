<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use App\Models\Questionnaire;
use Log;
class SendNewOrder extends Mailable
{
    use Queueable, SerializesModels;
    public $date;
    public $time;


    public $questionnaire;
    /**
     * Create a new message instance.
     */
    public function __construct($request, $questionnaire)
    {
        $dateFormat = date('d.m.Y', strtotime($request->date));
        $dateCarbonFormat = Carbon::createFromFormat('d.m.Y', $dateFormat)->locale('ru')->translatedFormat('j F Y');
        $this->date = $dateCarbonFormat;
        $this->time = $request->time;
        $this ->questionnaire =$questionnaire;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Новая запись на консультацию',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'mail.admin.send_new_order',
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
