<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contract;
use App\Models\FuturesState;
use App\Events\FuturesTickUpdated;
use App\Services\PriceService;
use Carbon\Carbon;

class RunFutures extends Command
{
    protected $signature = 'market:run-futures';
    protected $description = 'Run the futures price simulation engine';

    public function handle(PriceService $priceService)
    {
        $this->info('Starting futures price engine...');

        while (true) {
            $now = Carbon::now('Asia/Kolkata');

            $contracts = Contract::where('contract_type', 'FUTURE')
                ->where('is_active', true)
                ->with('instrument.underlyingState')
                ->get();

            foreach ($contracts as $contract) {
                $instrument = $contract->instrument;
                if (!$instrument || !$instrument->underlyingState) continue;

                $sessionStart = Carbon::today()->setTimeFromTimeString($instrument->session_start);
                $sessionEnd = Carbon::today()->setTimeFromTimeString($instrument->session_end);

                if (!$now->between($sessionStart, $sessionEnd)) continue;

                $state = FuturesState::firstOrCreate(
                    ['contract_id' => $contract->id],
                    ['last_price' => $instrument->underlyingState->last_price]
                );

                $timeToExpiry = $contract->expiry_date->diffInDays($now) / 365.0; // Years

                $newPrice = $priceService->calculateFuturesPrice(
                    $instrument->underlyingState->last_price,
                    $timeToExpiry,
                    config('market.risk_free_rate', 0.06)
                );

                $newPrice = round($newPrice / $instrument->tick_size) * $instrument->tick_size;

                $state->update(['last_price' => $newPrice]);

                event(new FuturesTickUpdated($contract->contract_symbol, $newPrice, $now));
            }

            sleep(1);
        }
    }
}
