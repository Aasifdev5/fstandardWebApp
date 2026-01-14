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
        'current_balance'             => 'decimal:2',
        'peak_balance'                => 'decimal:2',
        'total_profit'                => 'decimal:2',
        'total_loss'                  => 'decimal:2',
        'daily_drawdown'              => 'decimal:2',
        'overall_drawdown'            => 'decimal:2',
        'profit_target_percent'       => 'decimal:2',
        'max_daily_loss_percent'      => 'decimal:2',
        'max_overall_loss_percent'    => 'decimal:2',
        'current_daily_loss_percent'  => 'decimal:2',
        'current_overall_loss_percent' => 'decimal:2',
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
    // Relationships
    // ====================================================================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function trades(): HasMany
    {
        // Links to the trade_logs table (Historical/Closed trades)
        return $this->hasMany(TradeLog::class, 'challenge_id');
    }

    public function activeTrades(): HasMany
    {
        // Links to the trades table (Live/Open positions)
        return $this->hasMany(Trade::class, 'challenge_id');
    }
    // Challenge → PlanPurchase
    public function planPurchase()
    {
        return $this->belongsTo(PlanPurchase::class, 'plan_id');
    }

    // Shortcut: Challenge → PlanPurchase → FundingPlan
    public function fundingPlan()
{
    return $this->hasOneThrough(
        FundingPlan::class,   // final model
        PlanPurchase::class,  // intermediate model
        'id',                 // PlanPurchase primary key
        'id',                 // FundingPlan primary key
        'plan_id',            // Challenge foreign key to PlanPurchase
        'funding_plan_id'     // PlanPurchase foreign key to FundingPlan
    );
}



    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // ====================================================================
    // 🔥 CRITICAL FIX: Recalculate Stats Function
    // ====================================================================
    public function refreshStats()
    {
        // 1. Calculate Realized PnL from TradeLogs (Closed Trades)
        $closedStats = $this->trades()
            ->selectRaw('
                COALESCE(SUM(profit_loss), 0) as net_pnl,
                COALESCE(SUM(CASE WHEN profit_loss > 0 THEN profit_loss ELSE 0 END), 0) as total_profit,
                COALESCE(SUM(CASE WHEN profit_loss < 0 THEN ABS(profit_loss) ELSE 0 END), 0) as total_loss
            ')
            ->first();

        $netPnl      = $closedStats->net_pnl;
        $totalProfit = $closedStats->total_profit;
        $totalLoss   = $closedStats->total_loss;

        // 2. Calculate New Balance
        // Start Balance + Realized PnL
        $newBalance = $this->start_balance + $netPnl;

        // 3. Update the Challenge Record in DB
        $this->update([
            'current_balance' => $newBalance,
            'total_profit'    => $totalProfit,
            'total_loss'      => $totalLoss,
            'peak_balance'    => max($this->peak_balance, $newBalance), // Update High Water Mark
        ]);

        return $this;
    }

    // ====================================================================
    // Accessors & Scopes (Kept for compatibility)
    // ====================================================================

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'active'    => '<span class="badge bg-primary">Active</span>',
            'passed'    => '<span class="badge bg-success">Passed</span>',
            'failed'    => '<span class="badge bg-danger">Failed</span>',
            'suspended' => '<span class="badge bg-warning">Suspended</span>',
            default     => '<span class="badge bg-dark">Unknown</span>',
        };
    }

    public function getPhaseTextAttribute(): string
    {
        return match ($this->phase) {
            1 => 'Phase 1',
            2 => 'Phase 2',
            3 => 'Funded Account',
            default => 'Unknown',
        };
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    public function scopeUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
