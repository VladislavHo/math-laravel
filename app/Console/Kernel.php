<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [

    ];
    protected $middleware = [
        // Другие middleware...
        \Fruitcake\Cors\HandleCors::class,
    ];

    protected function commands()
    {

        $this->load(__DIR__.'/Commands'); 
        require base_path('routes/console.php'); 
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('send:scheduled-email')->everyMinute(); 
        // $schedule->command('send:send-daily-xlsx')->everyMinute();
        $schedule->command('send:send-daily-xlsx')->dailyAt('00:00');
    }
}