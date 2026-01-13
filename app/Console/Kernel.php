<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use App\Jobs\AutoCloseSimulatedTrades;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        /*
        |--------------------------------------------------------------------------
        | Trade Manager – Monitors active trades for SL / TARGET
        |--------------------------------------------------------------------------
        */
        $schedule->command('market:run-trade-manager')
            ->everyMinute()
            ->withoutOverlapping()
            ->onSuccess(fn () => Log::info('TradeManager executed'))
            ->onFailure(fn () => Log::error('TradeManager failed'));

        /*
        |--------------------------------------------------------------------------
        | News Engine – Synthetic market news
        |--------------------------------------------------------------------------
        */
        $schedule->command('market:run-news')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->onSuccess(fn () => Log::info('News engine executed'))
            ->onFailure(fn () => Log::error('News engine failed'));

        /*
        |--------------------------------------------------------------------------
        | Contract Generator – Monthly expiries
        |--------------------------------------------------------------------------
        */
        $schedule->command('market:generate-contracts')
            ->hourly()
            ->withoutOverlapping()
            ->onSuccess(fn () => Log::info('Contract generator executed'))
            ->onFailure(fn () => Log::error('Contract generator failed'));

        /*
        |--------------------------------------------------------------------------
        | Auto-Close Simulated Trades
        |--------------------------------------------------------------------------
        | IMPORTANT:
        | - everyFiveSeconds() REQUIRES: php artisan schedule:work
        | - Do NOT rely on cron for sub-minute intervals
        | - Job must be idempotent (status = OPEN)
        |--------------------------------------------------------------------------
        */

        $schedule->job(new AutoCloseSimulatedTrades())
            ->everyFiveSeconds()        // 🔹 Dev / Demo / Simulation
            // ->everyThirtySeconds()   // 🔸 Safer production option
            // ->everyMinute()          // 🔸 Conservative production option
            ->withoutOverlapping()
            ->onSuccess(fn () => Log::debug('AutoCloseSimulatedTrades completed'))
            ->onFailure(fn () => Log::error('AutoCloseSimulatedTrades failed'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
