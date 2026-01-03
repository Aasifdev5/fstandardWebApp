<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Str;

class TradePricingService
{
    /**
     * Calculate ₹/Point using the "Only Formula" [cite: 104-111]
     */
    public function rupeesPerPoint(float $accountSize, string $lotType, string $contractSymbol, float $currentPrice): float
    {
        // 1. Get Constants [cite: 133-135]
        $baseValue  = config('market_pricing.base_rupee_per_point');
        $refAccount = config('market_pricing.reference_account');
        $refPrice   = config('market_pricing.reference_price');

        // 2. Multipliers
        $lotMult = config("market_pricing.lot_multipliers.{$lotType}");
        if (is_null($lotMult)) throw new Exception("Invalid Lot Type: {$lotType}");

        $baseSymbol = $this->extractBaseSymbol($contractSymbol);
        $instMult = config("market_pricing.instrument_multipliers.{$baseSymbol}");
        if (is_null($instMult)) throw new Exception("Invalid Instrument: {$baseSymbol}");

        // 3. Price Normalization [cite: 94-98]
        $priceNormalization = $refPrice / $currentPrice;

        // 4. The Formula [cite: 106-111]
        return $baseValue
            * ($accountSize / $refAccount)
            * $lotMult
            * $instMult
            * $priceNormalization;
    }

    private function extractBaseSymbol(string $fullSymbol): string
    {
        // Logic to turn "FSI-NF50-F-20251230" into "FSI-NF50-F"
        return Str::beforeLast($fullSymbol, '-');
    }
}
