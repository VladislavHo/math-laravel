<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\SendScheduledEmail;
use Illuminate\Console\Scheduling\Schedule;
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();



Artisan::command('send:scheduled-email', function () {
    // Вызовите вашу команду или логику здесь
    $this->call(SendScheduledEmail::class);
})->describe('Отправить запланированные письма');

// Запланируйте задачу
$schedule = app(Schedule::class);
$schedule->command('send:scheduled-email')->everyMinute(); 