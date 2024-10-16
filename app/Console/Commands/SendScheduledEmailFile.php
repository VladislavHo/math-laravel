<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\Admin\SendXlsxFile as Mailable;
class SendScheduledEmailFile extends Command
{
    protected $signature = 'send:send-daily-xlsx';
    protected $description = 'Send daily email';

    public function handle()
    {


        (new Mailable())->sendUsersXlsx();
        $this->info('Daily email sent successfully!');
    }
}