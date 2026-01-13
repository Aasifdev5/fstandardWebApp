<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimulationConfig extends Model
{
    protected $table = 'simulation_configs';

    protected $fillable = [
        'user_id',          // null = global
        'force_outcome',    // 'NONE', 'TARGET_HIT', 'SL_HIT'
        'is_active',
        'notes',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The user this override belongs to (null for global rules)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the forced outcome for a specific user
     * Priority: user-specific > global > null (real market)
     */
    public static function getForcedOutcome(int $userId): ?string
    {
        // 1. User-specific override
        $userOverride = self::where('user_id', $userId)
            ->where('is_active', true)
            ->first();

        if ($userOverride && $userOverride->force_outcome !== 'NONE') {
            return $userOverride->force_outcome;
        }

        // 2. Global setting
        $global = self::whereNull('user_id')
            ->where('is_active', true)
            ->first();

        if ($global && $global->force_outcome !== 'NONE') {
            return $global->force_outcome;
        }

        // 3. Normal market behavior
        return null;
    }
}
