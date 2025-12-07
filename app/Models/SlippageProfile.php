<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SlippageProfile extends Model
{
    protected $table = 'slippage_profile';

    protected $fillable = [
        'user_id',
        'min_slippage',
        'max_slippage',
        'symbol_overrides',
        'time_overrides',
        'active',
    ];

    protected $casts = [
        'symbol_overrides' => 'array',
        'time_overrides' => 'array',
        'active' => 'boolean',
    ];

    /**
     * Relationship: User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
