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

            // 🔐 SAFETY: Normalize symbol (remove any existing FSI-)
            $baseSymbol = strtoupper($instrument->symbol);
            $baseSymbol = preg_replace('/^FSI-/', '', $baseSymbol);

            // 🔐 Enforce single prefix
            $symbol = "FSI-{$baseSymbol}";

            $expiryDates = $this->getNextThreeMonthlyExpiries();

            foreach ($expiryDates as $expiry) {

                /* ================= FUTURE ================= */
                $futureSymbol = "{$symbol}-F-{$expiry->format('Ymd')}";

                Contract::updateOrCreate(
                    ['contract_symbol' => $futureSymbol],
                    [
                        'instrument_id' => $instrument->id,
                        'contract_type' => 'FUTURE',
                        'expiry_date'   => $expiry,
                        'multiplier'    => $instrument->lot_size,
                        'is_active'     => true,
                    ]
                );

                /* ================= OPTIONS ================= */
                if (in_array($instrument->category, ['index', 'stock'])) {

                    $atm = round($instrument->base_price);
                    $step = $this->getStrikeStep($instrument->category, $atm);
                    $strikes = range($atm - ($step * 5), $atm + ($step * 5), $step);

                    foreach ($strikes as $strike) {
                        foreach (['CALL', 'PUT'] as $type) {

                            $opt = substr($type, 0, 2);
                            $optionSymbol = "{$symbol}-{$opt}-{$strike}-{$expiry->format('Ymd')}";

                            Contract::updateOrCreate(
                                ['contract_symbol' => $optionSymbol],
                                [
                                    'instrument_id'  => $instrument->id,
                                    'contract_type'  => 'OPTION',
                                    'option_type'    => $type,
                                    'strike_price'  => $strike,
                                    'expiry_date'   => $expiry,
                                    'multiplier'    => $instrument->lot_size,
                                    'is_active'     => true,
                                ]
                            );
                        }
                    }
                }
            }
        }

        $this->info('✅ Contracts generated safely (symbol normalized)');
    }

    private function getNextThreeMonthlyExpiries(): array
    {
        $dates = [];
        $current = Carbon::now();

        for ($i = 0; $i < 3; $i++) {
            $expiry = $current->copy()
                ->endOfMonth()
                ->previous(Carbon::THURSDAY);

            if ($expiry->isPast()) {
                $expiry = $current->copy()->addMonth()->endOfMonth()->previous(Carbon::THURSDAY);
            }

            $dates[] = $expiry;
            $current->addMonth();
        }

        return $dates;
    }

    private function getStrikeStep(string $category, float $price): int
    {
        if ($category === 'index') {
            return $price >= 20000 ? 100 : 50;
        }

        return match (true) {
            $price >= 2000 => 50,
            $price >= 500  => 20,
            default        => 10,
        };
    }
}
