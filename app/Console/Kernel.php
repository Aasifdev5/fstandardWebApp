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
        | MAINTENANCE TASKS (Run via standard Cron)
        |--------------------------------------------------------------------------
        */

        // Contract Generator – Monthly expiries
        $schedule->command('market:generate-contracts')
            ->hourly()
            ->withoutOverlapping()
            ->onSuccess(fn () => Log::info('Contract generator executed'))
            ->onFailure(fn () => Log::error('Contract generator failed'));

        // Database Pruning – Clean up old granular candle data (OHLC)
        // 🔥 NEW: Essential to prevent database bloat
        $schedule->command('market:prune')
            ->dailyAt('01:00')
            ->withoutOverlapping()
            ->onSuccess(fn () => Log::info('Market pruning completed'));

        /*
        |--------------------------------------------------------------------------
        | SIMULATION UPDATES (Run via standard Cron)
        |--------------------------------------------------------------------------
        */

        // News Engine – Synthetic market news
        $schedule->command('market:run-news')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->onSuccess(fn () => Log::info('News engine executed'))
            ->onFailure(fn () => Log::error('News engine failed'));

        // Auto-Close Simulated Trades (Paper Trading Logic)
        $schedule->job(new AutoCloseSimulatedTrades())
            ->everyFiveSeconds()
            ->withoutOverlapping()
            ->onSuccess(fn () => Log::debug('AutoCloseSimulatedTrades completed'))
            ->onFailure(fn () => Log::error('AutoCloseSimulatedTrades failed'));

        /*
        |--------------------------------------------------------------------------
        | 🔥 IMPORTANT NOTE ON REMOVED COMMANDS:
        | The following commands have been removed from the Scheduler:
        | 1. market:run-underlyings
        | 2. market:run-trade-manager
        | 3. psychometrics:run
        |
        | REASON: These contain "while(true)" loops. Running them here will
        | cause the scheduler to hang and eventually crash your server.
        | They MUST be run via SUPERVISOR.
        |--------------------------------------------------------------------------
        */
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
