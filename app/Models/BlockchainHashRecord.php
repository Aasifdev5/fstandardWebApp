<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlockchainHashRecord extends Model
{
    use HasFactory;

    protected $table = 'blockchain_hash_records';

    protected $fillable = [
        'user_id',
        'for_date',
        'chain',
        'tx_hash',
        'behaviour_metrics_hash',
        'meta',
    ];

    protected $casts = [
        'for_date' => 'date',
        'meta' => 'array',
    ];

    /**
     * Relationship: User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
