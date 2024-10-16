<?php

namespace App\Mail\Admin;

use App\Exports\UsersExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SendXlsxFile
{
    public function sendUsersXlsx()
    {
        $fileName = 'users.xlsx';
        // Создание файла Excel и отправка по электронной почте
        Mail::raw('Here is the users file.', function ($message) use ($fileName) {
            $message->to(env('MAIL_USERNAME'))
                    ->subject('Users List')
                    ->attachData(Excel::raw(new UsersExport, \Maatwebsite\Excel\Excel::XLSX), $fileName, [
                        'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    ]);
        });

        return 'Email sent successfully!';
    }
}