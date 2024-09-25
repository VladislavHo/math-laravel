<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Здесь вы можете регистрировать свои команды
        // $this->load(__DIR__.'/Commands')
        // $this->load(__DIR__.'/Commands')
    ];
    protected $middleware = [
        // Другие middleware...
        \Fruitcake\Cors\HandleCors::class,
    ];

    protected function commands()
    {
        // $this->info('Команда send:scheduled-email была вызвана');
        $this->load(__DIR__.'/Commands'); // Это должно загружать вашу команду
        require base_path('routes/console.php'); // Стандартные команды Artisan
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('send:scheduled-email')->everyMinute(); 
    }
}