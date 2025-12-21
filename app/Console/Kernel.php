<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // News engine – synthetic news events (infrequent, no need for second-level precision)
        $schedule->command('market:run-news')
                 ->everyFiveMinutes()  // You can change to ->everyMinute() if you want more frequent news
                 ->withoutOverlapping()
                 ->runInBackground()
                 ->onSuccess(fn() => Log::info('RunNews executed successfully'))
                 ->onFailure(fn() => Log::error('RunNews failed'));

        // Contract generator – create new monthly expiries automatically
        $schedule->command('market:generate-contracts')
                 ->hourly()
                 ->withoutOverlapping()
                 ->runInBackground()
                 ->onSuccess(fn() => Log::info('GenerateContracts executed successfully'))
                 ->onFailure(fn() => Log::error('GenerateContracts failed'));

        // Optional: Add your market:init-states command here if you want to run it daily (safety net)
        // $schedule->command('market:init-states')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
