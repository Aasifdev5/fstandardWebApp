<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DelayedFeedAssignment extends Model
{
    use HasFactory;

    protected $table = 'delayed_feed_assignments';

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
