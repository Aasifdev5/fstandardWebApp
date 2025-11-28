<?php

// 4. app/Models/Withdrawal.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $table = 'withdrawals';

    protected $fillable = [
        'user_id',
        'amount',
        'charge',
        'final_amount',
        'bank_name',
        'account_holder',
        'account_number',
        'ifsc_code',
        'trx',
        'utr',
        'status',
        'admin_feedback',
        'processed_at'
    ];

    protected $casts = [
        'amount'       => 'decimal:2',
        'charge'       => 'decimal:2',
        'final_amount' => 'decimal:2',
        'processed_at' => 'datetime',
    ];

    const STATUS_PENDING   = 0;
    const STATUS_APPROVED  = 1;
    const STATUS_REJECTED  = 2;
    const STATUS_PROCESSED = 3;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
