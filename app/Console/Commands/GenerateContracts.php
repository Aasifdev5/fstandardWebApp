<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Instrument;
use App\Models\Contract;
use Carbon\Carbon;

class GenerateContracts extends Command
{
    protected $signature = 'market:generate-contracts';
    protected $description = 'Generate futures and options contracts';

    public function handle()
    {
        $instruments = Instrument::where('is_active', true)->get();

        foreach ($instruments as $instrument) {
            $expiryDates = $this->getNextThreeMonthlyExpiries();

            foreach ($expiryDates as $expiry) {
                // Create Future
                $futureSymbol = "FSI-{$instrument->symbol}-F-{$expiry->format('Ymd')}";
                Contract::updateOrCreate(
                    ['contract_symbol' => $futureSymbol],
                    [
                        'instrument_id' => $instrument->id,
                        'contract_type' => 'FUTURE',
                        'expiry_date' => $expiry,
                        'multiplier' => $instrument->lot_size,
                    ]
                );

                // Options only for index/stock
                if (in_array($instrument->category, ['index', 'stock'])) {
                    $atm = $instrument->base_price; // Use base_price as ATM
                    $strikeStep = $this->getStrikeStep($instrument->category, $atm);
                    $strikes = range($atm * 0.9, $atm * 1.1, $strikeStep);

                    foreach ($strikes as $strike) {
                        foreach (['CALL', 'PUT'] as $type) {
                            $optionSymbol = "FSI-{$instrument->symbol}-" . substr($type, 0, 2) . "-{$strike}-{$expiry->format('Ymd')}";
                            Contract::updateOrCreate(
                                ['contract_symbol' => $optionSymbol],
                                [
                                    'instrument_id' => $instrument->id,
                                    'contract_type' => 'OPTION',
                                    'option_type' => $type,
                                    'strike_price' => $strike,
                                    'expiry_date' => $expiry,
                                    'multiplier' => $instrument->lot_size,
                                ]
                            );
                        }
                    }
                }
            }
        }

        $this->info('Contracts generated.');
    }

    private function getNextThreeMonthlyExpiries(): array
    {
        $expiries = [];
        $current = Carbon::now();
        for ($i = 0; $i < 3; $i++) {
            $lastThursday = $current->copy()->lastOfMonth()->previous(Carbon::THURSDAY);
            if ($lastThursday->lt($current)) {
                $lastThursday = $current->copy()->addMonth()->lastOfMonth()->previous(Carbon::THURSDAY);
            }
            $expiries[] = $lastThursday;
            $current = $current->addMonth();
        }
        return $expiries;
    }

    private function getStrikeStep(string $category, float $price): float
    {
        if ($category === 'index') {
            return $price > 10000 ? 100 : 50;
        }
        return $price > 1000 ? 50 : ($price > 500 ? 20 : 10);
    }
}
