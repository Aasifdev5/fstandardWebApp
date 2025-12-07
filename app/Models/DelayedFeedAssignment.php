<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DelayedFeedAssignment extends Model
{
    protected $table = 'delayed_feed_assignment';

    protected $fillable = [
        'user_id',
        'delay_seconds',
        'reason',
        'assigned_at',
        'active',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
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
