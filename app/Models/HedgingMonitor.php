<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class HedgingMonitor extends Model
{
    use HasFactory;

    protected $table = 'hedging_monitors';

    protected $fillable = [
        'user_a',
        'user_b',
        'triggers',
        'hedging_score',
        'action',
        'evidence',
    ];

    protected $casts = [
        'triggers' => 'array',
        'evidence' => 'array',
        'hedging_score' => 'float',
    ];

    /**
     * Get User A
     */
    public function userA()
    {
        return $this->belongsTo(User::class, 'user_a');
    }

    /**
     * Get User B
     */
    public function userB()
    {
        return $this->belongsTo(User::class, 'user_b');
    }
}
