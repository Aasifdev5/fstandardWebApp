<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    // ====================================================================
    // Fillable fields – safe for mass assignment
    // ====================================================================
    protected $fillable = [
        'user_id',
        'challenge_id',
        'lot_type',
        'stock_symbol',
        'security_id',
        'order_side',
        'order_type',
        'product_type',
        'price',
        'stop_loss',
        'target',
        'close_reason',
        'trigger_price',
        'quantity',
        'closed_at',
        'pnl',
        'disclosed_quantity',
        'filled_quantity',
        'filled_percentage',
        'average_price',
        'total_amount',
        'brokerage',
        'status',
        'trx',
        'parent_order_id',
        'correlation_id',
        'placed_by',
        'meta',
    ];

    // ====================================================================
    // Casts – proper typing
    // ====================================================================
    protected $casts = [
        'price'             => 'decimal:2',
        'stop_loss'         => 'decimal:2',
        'target'            => 'decimal:2',
        'trigger_price'     => 'decimal:2',
        'quantity'          => 'decimal:4',
        'disclosed_quantity'=> 'decimal:4',
        'filled_quantity'   => 'decimal:4',
        'average_price'     => 'decimal:2',
        'total_amount'      => 'decimal:2',
        'brokerage'         => 'decimal:2',
        'filled_percentage' => 'integer',
        'meta'              => 'array',
        'order_side'        => 'integer',
        'order_type'        => 'integer',
        'status'            => 'integer',
    ];

    // ====================================================================
    // Constants – Human readable status & types
    // ====================================================================
    const STATUS_OPEN      = 0;
    const STATUS_COMPLETED = 1;
    const STATUS_PARTIAL   = 2;
    const STATUS_CANCELLED = 9;

    const SIDE_BUY  = 1;
    const SIDE_SELL = 2;

    const TYPE_LIMIT = 1;
    const TYPE_MARKET = 2;
    const TYPE_SL    = 3;
    const TYPE_SL_M  = 4;

    // ====================================================================
    // Relationships
    // ====================================================================
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function challenge(): BelongsTo
    {
        return $this->belongsTo(Challenge::class);
    }

    public function trades(): HasMany
    {
        return $this->hasMany(TradeLog::class, 'order_id');
    }

    // ====================================================================
    // Accessors – Beautiful display in Blade / API
    // ====================================================================
    public function getSideTextAttribute(): string
    {
        return $this->order_side == self::SIDE_BUY ? 'BUY' : 'SELL';
    }

    public function getSideBadgeAttribute(): string
    {
        return $this->order_side == self::SIDE_BUY
            ? '<span class="badge bg-success">BUY</span>'
            : '<span class="badge bg-danger">SELL</span>';
    }

    public function getTypeTextAttribute(): string
    {
        return match($this->order_type) {
            self::TYPE_LIMIT  => 'LIMIT',
            self::TYPE_MARKET => 'MARKET',
            self::TYPE_SL     => 'SL',
            self::TYPE_SL_M   => 'SL-M',
            default           => 'UNKNOWN',
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            self::STATUS_OPEN      => '<span class="badge bg-warning text-dark">Open</span>',
            self::STATUS_COMPLETED => '<span class="badge bg-success">Completed</span>',
            self::STATUS_PARTIAL   => '<span class="badge bg-info">Partial</span>',
            self::STATUS_CANCELLED => '<span class="badge bg-danger">Cancelled</span>',
            default                => '<span class="badge bg-secondary">Unknown</span>',
        };
    }

    public function getProgressAttribute(): string
    {
        if ($this->quantity <= 0) return '0%';
        $percent = ($this->filled_quantity / $this->quantity) * 100;
        return number_format($percent, 1) . '%';
    }

    // ====================================================================
    // New: Accessors for nicely formatted SL & Target
    // ====================================================================
    public function getStopLossFormattedAttribute(): ?string
    {
        return $this->stop_loss !== null ? number_format($this->stop_loss, 2) : null;
    }

    public function getTargetFormattedAttribute(): ?string
    {
        return $this->target !== null ? number_format($this->target, 2) : null;
    }

    // ====================================================================
    // Scopes – Easy filtering
    // ====================================================================
    public function scopeBuy($query)
    {
        return $query->where('order_side', self::SIDE_BUY);
    }

    public function scopeSell($query)
    {
        return $query->where('order_side', self::SIDE_SELL);
    }

    public function scopeOpen($query)
    {
        return $query->where('status', self::STATUS_OPEN);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', [self::STATUS_OPEN, self::STATUS_PARTIAL]);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeForChallenge($query, $challengeId)
    {
        return $query->where('challenge_id', $challengeId);
    }

    // ====================================================================
    // Optional: Helper method to validate SL/Target against entry price
    // ====================================================================
    public function validateSLTarget(float $entryPrice): array
    {
        $errors = [];

        if ($this->order_side == self::SIDE_BUY) {
            if ($this->stop_loss !== null && $this->stop_loss >= $entryPrice) {
                $errors[] = 'Stop Loss for BUY must be BELOW entry price';
            }
            if ($this->target !== null && $this->target <= $entryPrice) {
                $errors[] = 'Target for BUY must be ABOVE entry price';
            }
        }

        if ($this->order_side == self::SIDE_SELL) {
            if ($this->stop_loss !== null && $this->stop_loss <= $entryPrice) {
                $errors[] = 'Stop Loss for SELL must be ABOVE entry price';
            }
            if ($this->target !== null && $this->target >= $entryPrice) {
                $errors[] = 'Target for SELL must be BELOW entry price';
            }
        }

        return $errors;
    }
}
