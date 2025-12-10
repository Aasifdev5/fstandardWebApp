<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SlippageProfile extends Model
{
    use HasFactory;

    protected $table = 'slippage_profiles';

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
