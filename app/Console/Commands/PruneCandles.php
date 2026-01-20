<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Candle;

class PruneCandles extends Command
{
    protected $signature = 'market:prune';
    protected $description = 'Clean up old granular candle data';

    public function handle()
    {
        $this->info('🧹 Starting database pruning...');

        // Delete 1m candles older than 48 hours
        $count1 = Candle::where('timeframe', '1m')->where('timestamp', '<', now()->subHours(48))->delete();

        // Delete 5m and 15m candles older than 14 days
        $count2 = Candle::whereIn('timeframe', ['5m', '15m'])->where('timestamp', '<', now()->subDays(14))->delete();

        $this->info("Cleaned up " . ($count1 + $count2) . " rows. Database is lean!");
    }
}
