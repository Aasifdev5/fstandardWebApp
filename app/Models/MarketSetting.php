<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class MarketSetting extends Model
{
    protected $fillable = ['key', 'value'];

    // 1. Ensure the JSON from DB is converted to a PHP Array automatically
    protected $casts = [
        'value' => 'array',
    ];

    /**
     * Retrieve config with caching.
     * Updated to use first() so casting is applied correctly.
     */
    public static function getSimulationConfig()
    {
        return Cache::rememberForever('market_simulation_config', function () {
            // WE USE 'first()' INSTEAD OF 'value()' HERE
            // 'value()' returns the raw JSON string (ignoring casts).
            // 'first()' hydrates the model and converts it to an array.
            $setting = self::where('key', 'simulation_config')->first();

            return $setting ? $setting->value : [];
        });
    }

    /**
     * Clear cache automatically when the model is updated
     */
    protected static function booted()
    {
        static::saved(function ($setting) {
            // This matches the key used in the Controller: 'market_simulation_config'
            Cache::forget('market_' . $setting->key);
        });
    }
}
