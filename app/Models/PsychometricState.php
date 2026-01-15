<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PsychometricState extends Model
{
    protected $fillable = [
        'user_id',
        'confidence',
        'fear',
        'discipline',
        'aggression',
        'state_strength',
        'starts_at',
        'ends_at',
        'source', // trade, pattern, admin, ai
    ];

    protected $casts = [
        'confidence'     => 'float',
        'fear'           => 'float',
        'discipline'     => 'float',
        'aggression'     => 'float',
        'state_strength' => 'float',
        'starts_at'      => 'datetime',
        'ends_at'        => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
