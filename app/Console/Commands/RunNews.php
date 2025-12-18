<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Instrument;
use App\Models\InstrumentNewsState;
use Carbon\Carbon;

class RunNews extends Command
{
    protected $signature = 'market:run-news';
    protected $description = 'Run news engine';

    public function handle()
    {
        while (true) {
            $instruments = Instrument::all();

            foreach ($instruments as $instrument) {
                $news = InstrumentNewsState::firstOrCreate(['instrument_id' => $instrument->id]);

                if ($news->ends_at && $news->ends_at < Carbon::now()) {
                    $news->update(['active' => false, 'ends_at' => null]);
                }

                // Random event start (adjust probability, e.g., 1% per minute per sector)
                if (rand(1, 100) <= 1) {
                    $direction = rand(0, 1) ? 'up' : 'down';
                    $duration = rand(15, 180); // minutes
                    $news->update([
                        'active' => true,
                        'direction' => $direction,
                        'ends_at' => Carbon::now()->addMinutes($duration),
                    ]);
                }
            }

            sleep(60); // Every minute
        }
    }
}
