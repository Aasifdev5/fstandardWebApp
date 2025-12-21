<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Instrument;
use App\Models\UnderlyingState;

class InitializeMarketStates extends Command
{
    protected $signature = 'market:init-states';
    protected $description = 'Initialize underlying_state rows for all instruments';

    public function handle()
    {
    $instruments = Instrument::all();

        foreach ($instruments as $instrument) {
            UnderlyingState::updateOrCreate(
                ['instrument_id' => $instrument->id],
                [
                    'last_price' => $instrument->base_price,
                    'regime' => 'normal',
                    'drift' => 0.0,
                    'volatility' => 0.0,
                ]
            );
        }

        $this->info('Underlying states initialized for ' . $instruments->count() . ' instruments.');
    }
}
