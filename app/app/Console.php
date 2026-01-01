<?php

namespace App;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Console extends ConsoleKernel
{
    /**
     * Register the application's commands.
     */
    protected function commands(): void
    {
        // Команды загружаются автоматически из php/Console/Commands/
        // Ничего добавлять не нужно!
    }

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    }
}
