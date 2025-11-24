<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Affiliate extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'affiliates'; // ← ADD THIS LINE!

    protected $guarded = [];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'earnings' => 'decimal:2',
        'commission_rate' => 'decimal:2',
    ];

    protected static function booted()
    {
        static::creating(function ($affiliate) {
            $affiliate->referral_code = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10));
        });
    }
}
