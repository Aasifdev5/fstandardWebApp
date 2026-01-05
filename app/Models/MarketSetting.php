<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class MarketSetting extends Model
{
    protected $table = 'market_settings';

    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * CRITICAL:
     * This ensures JSON becomes a PHP array
     */
    protected $casts = [
        'value' => 'array',
    ];

    /**
     * Fetch simulation config with permanent cache
     * Uses first() so casts are applied correctly
     */
    public static function getSimulationConfig(): array
    {
        return Cache::rememberForever('market_simulation_config', function () {
            $setting = self::where('key', 'simulation_config')->first();
            return $setting?->value ?? [];
        });
    }

    /**
     * Auto-clear cache when config changes
     */
    protected static function booted()
    {
        static::saved(function ($setting) {
            Cache::forget('market_simulation_config');
        });

        static::deleted(function ($setting) {
            Cache::forget('market_simulation_config');
        });
    }
}
