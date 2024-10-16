<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ScheduledEmail as Mailable;
use App\Models\ScheduledEmailModel ;
use App\Services\ScheduledTelegram ;
class SendScheduledEmail extends Command
{
    protected $signature = 'send:scheduled-email';

    protected $description = 'Отправить запланированные письма';

    public function handle()
    {
        $emails = ScheduledEmailModel::where('send_at', '<=', now())->get(); 
        // $telegramSendMessage = new ScheduledTelegram();
        $this->info('Команда send:scheduled-email была вызвана');
        foreach ($emails as $email) {
            Mail::to($email->recipient)->send(new Mailable($email -> recipient));


            (new ScheduledTelegram())->sendMessage($email->recipient);

            
            $email->delete(); 
        }

        $this->info('Запланированные письма отправлены!');
    }
}