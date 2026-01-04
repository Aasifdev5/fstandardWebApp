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
        // 1. Trade Manager – Monitors active orders for Stop Loss & Target
        // We schedule it every minute with 'withoutOverlapping'.
        // Since the command has a while(true) loop, this effectively ensures it's always running.
        // If it crashes, the scheduler restarts it within a minute.
        $schedule->command('market:run-trade-manager')
                 ->everyMinute()
                 ->withoutOverlapping()
                 ->runInBackground()
                 ->onSuccess(fn() => Log::info('TradeManager checks running'))
                 ->onFailure(fn() => Log::error('TradeManager failed'));

        // 2. News engine – synthetic news events
        $schedule->command('market:run-news')
                 ->everyFiveMinutes()
                 ->withoutOverlapping()
                 ->runInBackground()
                 ->onSuccess(fn() => Log::info('RunNews executed successfully'))
                 ->onFailure(fn() => Log::error('RunNews failed'));

        // 3. Contract generator – create new monthly expiries automatically
        $schedule->command('market:generate-contracts')
                 ->hourly()
                 ->withoutOverlapping()
                 ->runInBackground()
                 ->onSuccess(fn() => Log::info('GenerateContracts executed successfully'))
                 ->onFailure(fn() => Log::error('GenerateContracts failed'));

        // Optional: Initialize states daily if needed
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
