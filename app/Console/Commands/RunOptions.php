<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contract;
use App\Models\OptionsState;
use App\Events\OptionsTickUpdated;
use App\Services\PriceService;
use Carbon\Carbon;

class RunOptions extends Command
{
    protected $signature = 'market:run-options';
    protected $description = 'Run the options price simulation engine';

    public function handle(PriceService $priceService)
    {
        $this->info('Starting options price engine...');

        while (true) {
            $now = Carbon::now('Asia/Kolkata');

            $contracts = Contract::where('contract_type', 'OPTION')
                ->where('is_active', true)
                ->with('instrument.underlyingState')
                ->get();

            foreach ($contracts as $contract) {
                $instrument = $contract->instrument;
                if (!$instrument || !$instrument->underlyingState) continue;

                $sessionStart = Carbon::today()->setTimeFromTimeString($instrument->session_start);
                $sessionEnd = Carbon::today()->setTimeFromTimeString($instrument->session_end);

                if (!$now->between($sessionStart, $sessionEnd)) continue;

                $state = OptionsState::firstOrCreate(
                    ['contract_id' => $contract->id],
                    ['last_price' => 0, 'implied_volatility' => config("market.base_option_volatility.{$instrument->category}", 0.2)]
                );

                $futuresPrice = $contract->instrument->underlyingState->last_price; // Use spot as approx for simplicity
                $timeToExpiry = $contract->expiry_date->diffInDays($now) / 365.0;

                $adjustedVol = $priceService->adjustImpliedVolForSmile(
                    $contract->strike_price,
                    $futuresPrice,
                    $state->implied_volatility,
                    config('market.option_smile_strength', 0.10)
                );

                $newPrice = $priceService->calculateBlackOptionPrice(
                    $futuresPrice,
                    $contract->strike_price,
                    $timeToExpiry,
                    $adjustedVol,
                    $contract->option_type
                );

                $newPrice = round($newPrice / $instrument->tick_size) * $instrument->tick_size;

                $state->update(['last_price' => $newPrice, 'implied_volatility' => $adjustedVol]);

                event(new OptionsTickUpdated($contract->contract_symbol, $newPrice, $now));
            }

            sleep(1);
        }
    }
}
