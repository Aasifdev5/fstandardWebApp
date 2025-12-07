<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Challenge extends Model
{
    use HasFactory;

    protected $table = 'challenges';

    protected $fillable = [
        'user_id',
        'plan_id',
        'capacity_value',
        'start_balance',
        'current_balance',
        'peak_balance',
        'total_profit',
        'total_loss',
        'daily_drawdown',
        'overall_drawdown',
        'phase',
        'status',
        'min_days_required',
        'valid_days_completed',
        'max_trading_days',
        'trading_days_elapsed',
        'profit_target_percent',
        'max_daily_loss_percent',
        'max_overall_loss_percent',
        'current_daily_loss_percent',
        'current_overall_loss_percent',
        'next_payout_eligible_at',
        'payout_amount',
        'last_payout_at',
        'started_at',
        'ended_at',
        'passed_at',
        'failed_at',
        'account_id',
        'meta',
        'is_demo',
    ];

    protected $casts = [
        'capacity_value'              => 'decimal:2',
        'start_balance'               => 'decimal:2',
        'current_balance'              => 'decimal:2',
        'peak_balance'                => 'decimal:2',
        'total_profit'                => 'decimal:2',
        'total_loss'                  => 'decimal:2',
        'daily_drawdown'              => 'decimal:2',
        'overall_drawdown'            => 'decimal:2',
        'profit_target_percent'       => 'decimal:2',
        'max_daily_loss_percent'      => 'decimal:2',
        'max_overall_loss_percent'    => 'decimal:2',
        'current_daily_loss_percent'  => 'decimal:2',
        'current_overall_loss_percent'=> 'decimal:2',
        'payout_amount'               => 'decimal:2',
        'started_at'                  => 'datetime',
        'ended_at'                    => 'datetime',
        'passed_at'                   => 'datetime',
        'failed_at'                   => 'datetime',
        'next_payout_eligible_at'     => 'datetime',
        'last_payout_at'              => 'datetime',
        'meta'                        => 'array',
        'is_demo'                     => 'boolean',
    ];

    // ====================================================================
    // Constants
    // ====================================================================
    const PHASE_ONE     = 1;
    const PHASE_TWO     = 2;
    const PHASE_FUNDED  = 3;

    const STATUS_ACTIVE    = 'active';
    const STATUS_PASSED    = 'passed';
    const STATUS_FAILED    = 'failed';
    const STATUS_SUSPENDED = 'suspended';
    const STATUS_REFUNDED  = 'refunded';
    const STATUS_FUNDED    = 'funded';

    // ====================================================================
    // Relationships
    // ====================================================================
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(FundingPlan::class); // You should have a plans table
    }

    public function trades(): HasMany
    {
        return $this->hasMany(TradeLog::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // ====================================================================
    // Accessors
    // ====================================================================
    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'active'     => '<span class="badge bg-primary">Active</span>',
            'passed'     => '<span class="badge bg-success">Passed</span>',
            'failed'     => '<span class="badge bg-danger">Failed</span>',
            'suspended'  => '<span class="badge bg-warning">Suspended</span>',
            'funded'     => '<span class="badge bg-info">Funded</span>',
            'refunded'   => '<span class="badge bg-secondary">Refunded</span>',
            default      => '<span class="badge bg-dark">Unknown</span>',
        };
    }

    public function getPhaseTextAttribute(): string
    {
        return match($this->phase) {
            1 => 'Phase 1',
            2 => 'Phase 2',
            3 => 'Funded Account',
            default => 'Unknown',
        };
    }

    public function getProfitProgressAttribute(): float
    {
        if ($this->profit_target_percent <= 0) return 0;
        return round(($this->total_profit / ($this->capacity_value * $this->profit_target_percent / 100)), 2);
    }

    public function getIsBreachedDailyAttribute(): bool
    {
        return $this->current_daily_loss_percent >= $this->max_daily_loss_percent;
    }

    public function getIsBreachedOverallAttribute(): bool
    {
        return $this->current_overall_loss_percent >= $this->max_overall_loss_percent;
    }

    // ====================================================================
    // Scopes
    // ====================================================================
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopePhaseOne($query)
    {
        return $query->where('phase', 1);
    }

    public function scopePhaseTwo($query)
    {
        return $query->where('phase', 2);
    }

    public function scopePassed($query)
    {
        return $query->where('status', 'passed');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopeUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
