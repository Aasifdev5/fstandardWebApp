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
        // Run Underlyings every minute
        $schedule->command('market:run-underlyings')
                 ->everyMinute()
                 ->withoutOverlapping()
                 ->runInBackground()
                 ->onSuccess(fn() => Log::info('RunUnderlyings executed successfully'))
                 ->onFailure(fn() => Log::error('RunUnderlyings failed'));

        // Run Options every minute
        $schedule->command('market:run-options')
                 ->everyMinute()
                 ->withoutOverlapping()
                 ->runInBackground()
                 ->onSuccess(fn() => Log::info('RunOptions executed successfully'))
                 ->onFailure(fn() => Log::error('RunOptions failed'));

        // Run News every 5 minutes
        $schedule->command('market:run-news')
                 ->everyFiveMinutes()
                 ->withoutOverlapping()
                 ->runInBackground()
                 ->onSuccess(fn() => Log::info('RunNews executed successfully'))
                 ->onFailure(fn() => Log::error('RunNews failed'));

        // Run Futures every minute
        $schedule->command('market:run-futures')
                 ->everyMinute()
                 ->withoutOverlapping()
                 ->runInBackground()
                 ->onSuccess(fn() => Log::info('RunFutures executed successfully'))
                 ->onFailure(fn() => Log::error('RunFutures failed'));

        // Generate Contracts every hour
        $schedule->command('market:generate-contracts')
                 ->hourly()
                 ->withoutOverlapping()
                 ->runInBackground()
                 ->onSuccess(fn() => Log::info('GenerateContracts executed successfully'))
                 ->onFailure(fn() => Log::error('GenerateContracts failed'));
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
