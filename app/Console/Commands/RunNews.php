<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Instrument;
use App\Models\InstrumentNewsState;
use App\Models\MarketSetting;
use Carbon\Carbon;

class RunNews extends Command
{
    protected $signature = 'market:run-news';
    protected $description = 'Run news engine';

    public function handle()
    {
        $this->info('Running News Engine...');

        while (true) {
            $instruments = Instrument::all();

            // 🔥 Fetch Config
            $marketConfig = MarketSetting::getSimulationConfig();
            $stressMult   = (float) ($marketConfig['global_stress_multiplier'] ?? 1.0);
            $tickSpeed    = (int) ($marketConfig['update_speed_ms'] ?? 1000);

            foreach ($instruments as $instrument) {
                $news = InstrumentNewsState::firstOrCreate(['instrument_id' => $instrument->id]);

                if ($news->ends_at && $news->ends_at < Carbon::now()) {
                    $news->update(['active' => false, 'ends_at' => null]);
                }

                // 🔥 ADJUST PROBABILITY BASED ON STRESS
                $baseChance = 1;
                $adjustedChance = $baseChance * $stressMult;

                if (rand(1, 1000) <= ($adjustedChance * 10)) {
                    $direction = rand(0, 1) ? 'up' : 'down';

                    // High stress markets have shorter news cycles
                    $duration = rand(15, 180) / max(1, $stressMult);

                    $news->update([
                        'active' => true,
                        'direction' => $direction,
                        'ends_at' => Carbon::now()->addMinutes((int)$duration),
                    ]);

                    $this->info("News triggered for {$instrument->symbol}: {$direction}");
                }
            }

            // 🔥 UPDATE: Dynamic Sleep for News
            // If engine is normal (1000ms), we wait 60 seconds (60 * 1000ms).
            // If engine is FAST (200ms), we wait 12 seconds (60 * 200ms).
            // This keeps the "Time Scale" consistent.
            $sleepTimeMs = 60 * $tickSpeed;

            // Safety: Don't sleep less than 1 second to avoid spamming DB
            $sleepTimeUs = max(1000000, $sleepTimeMs * 1000);

            usleep($sleepTimeUs);
        }
    }
}
