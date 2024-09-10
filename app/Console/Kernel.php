<?php

// app/Console/Kernel.php
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Schedule the report command to run daily
        $schedule->command('reports:send')->daily();
    }

    protected $commands = [
        Commands\SendCauseReports::class,
    ];
}

