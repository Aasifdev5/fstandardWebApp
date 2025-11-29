<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanPurchase extends Model
{
    use HasFactory;

    protected $table = 'plan_purchases';

    protected $fillable = [
        'user_id',
        'funding_plan_id',
        'amount',
        'mt4_login',
        'mt4_password',
        'mt4_server',
        'gateway',              // razorpay, phonepe, paypal
        'transaction_id',       // our internal TXN_xxx
        'gateway_order_id',     // order ID from gateway (Razorpay order_id, PayPal order ID, PhonePe merchantTransactionId)
        'gateway_payment_id',   // final payment ID after success
        'gateway_response',     // full raw response (json/array)
        'gateway_signature',    // Razorpay signature
        'status',               // pending → approved / rejected / failed
        'notes',
        'approved_by',
        'approved_at',
        'expires_at'
    ];

    protected $casts = [
        'amount'           => 'decimal:2',
        'gateway_response' => 'array',
        'approved_at'      => 'datetime',
        'expires_at'       => 'datetime',
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(FundingPlan::class, 'funding_plan_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'approved'  => '<span class="badge bg-success">Approved</span>',
            'rejected'  => '<span class="badge bg-danger">Rejected</span>',
            'pending'   => '<span class="badge bg-warning text-dark">Pending</span>',
            'failed'    => '<span class="badge bg-secondary">Failed</span>',
            'completed' => '<span class="badge bg-info">Paid (Auto)</span>',
            default     => '<span class="badge bg-light text-dark">Unknown</span>',
        };
    }

    public function getGatewayNameAttribute()
    {
        return match ($this->gateway) {
            'razorpay' => 'Razorpay',
            'phonepe'  => 'PhonePe',
            'paypal'   => 'PayPal',
            default    => ucfirst($this->gateway ?? 'Unknown'),
        };
    }

    public function isActiveEvaluation()
    {
        return $this->status === 'approved' &&
               ($this->expires_at === null || $this->expires_at->isFuture());
    }
}
