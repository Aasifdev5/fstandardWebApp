<?php

namespace App\Services;

use App\Models\MarketSetting; // ✅ Import your model
use Exception;
use Illuminate\Support\Str;

class TradePricingService
{
    /**
     * Calculate ₹/Point using the dynamic DB config
     */
    public function rupeesPerPoint(float $accountSize, string $lotType, string $contractSymbol, float $currentPrice): float
    {
        // 1. Fetch Config from Database (Cached)
        $config = MarketSetting::getSimulationConfig();

        // 🛑 Safety Check: If config is empty, fallback or throw error
        if (empty($config)) {
            // You can either throw an error or return a default
             throw new Exception("Market Configuration not found in database.");
        }

        // 2. Get Constants from the JSON structure
        // Note: We use the keys exactly as they appear in your DB JSON
        $baseValue  = $config['base_rupee_per_point'] ?? 75; // Default from your JSON
        $refAccount = $config['reference_account'] ?? 1000000;
        $refPrice   = $config['reference_price'] ?? 24000;

        // 3. Lot Multipliers
        // Your DB has keys in lowercase ('micro', 'mini'), so we force input to lowercase
        $lotKey = strtolower($lotType);
        $lotMult = $config['lot_multipliers'][$lotKey] ?? null;

        if (is_null($lotMult)) {
            // Fallback: Try uppercase if lowercase didn't work, just in case
            $lotMult = $config['lot_multipliers'][$lotType] ?? 1.0;
        }

        // 4. Instrument Multipliers
        $baseSymbol = $this->extractBaseSymbol($contractSymbol);

        // Try exact match first, then fallback to default 1.0
        $instMult = $config['instrument_multipliers'][$baseSymbol] ?? 1.0;

        // 5. Price Normalization
        // Avoid division by zero
        $priceNormalization = ($currentPrice > 0) ? ($refPrice / $currentPrice) : 1;

        // 6. The Formula
        return $baseValue
            * ($accountSize / $refAccount)
            * $lotMult
            * $instMult
            * $priceNormalization;
    }

    private function extractBaseSymbol(string $fullSymbol): string
    {
        // Your DB keys look like "FSI-NF50-F"
        // If the symbol comes in as "FSI-NF50-F-20260115", we need to strip the date.

        // If it has 3 or more hyphens, assume it has a date suffix
        if (substr_count($fullSymbol, '-') >= 3) {
            return Str::beforeLast($fullSymbol, '-');
        }

        return $fullSymbol;
    }
}
