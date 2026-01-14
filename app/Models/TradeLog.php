<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class TradeLog extends Model
{
    use HasFactory;

    // ====================================================================
    // Table & Connection (optional – remove if using default)
    // ====================================================================
    protected $table = 'trade_logs';

    // ====================================================================
    // Mass Assignment – All fillable fields
    // ====================================================================
    protected $fillable = [
        'uuid',
        'user_id',
        'challenge_id',           // optional – if you track per challenge/contest
        'strategy_id',            // optional – if you tag strategies
        'symbol',
        'direction',              // 'long' or 'short' (or 'buy'/'sell')
        'entry_price',
        'exit_price',
        'entry_time',
        'exit_time',
        'quantity',               // or lot_size
        'profit_loss',            // absolute P&L
        'profit_loss_percent',    // % return
        'commission',
        'swap',
        'stop_loss',
        'take_profit',
        'stop_loss_used',
        'take_profit_used',
        'trailing_stop_used',
        'slippage',
        'holding_seconds',
        'trade_type',             // 'scalping', 'intraday', 'swing', 'position', 'options', etc.
        'exchange',               // 'NSE', 'BSE', 'MCX', 'BINANCE', etc.
        'segment',                // 'EQ', 'FUT', 'OPT', 'CURRENCY', etc.
        'order_ids',              // JSON array of broker order IDs
        'broker_trade_ids',       // JSON array of executed trade IDs
        'meta',                   // free JSON field for anything (tags, notes, screenshots link, etc.)
        'is_paper',               // true = paper trade, false = live
        'delayed_feed',           // was the data feed delayed?
        'closed_at',              // timestamp when trade was fully closed
    ];

    // ====================================================================
    // Casts – Proper typing
    // ====================================================================
    protected $casts = [
        'entry_time'          => 'datetime',
        'exit_time'           => 'datetime',
        'closed_at'           => 'datetime',
        'entry_price'         => 'decimal:5',
        'exit_price'          => 'decimal:5',
        'stop_loss'           => 'decimal:5',
        'take_profit'         => 'decimal:5',
        'profit_loss'         => 'decimal:5',
        'profit_loss_percent' => 'decimal:4',
        'commission'          => 'decimal:5',
        'swap'                => 'decimal:5',
        'slippage'            => 'decimal:5',
        'quantity'            => 'decimal:8',
        'meta'                => 'array',
        'order_ids'           => 'array',
        'broker_trade_ids'    => 'array',
        'stop_loss_used'      => 'boolean',
        'take_profit_used'    => 'boolean',
        'trailing_stop_used'  => 'boolean',
        'is_paper'            => 'boolean',
        'delayed_feed'        => 'boolean',
    ];

    // ====================================================================
    // Boot – Auto generate UUID
    // ====================================================================
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }

            // Auto-calculate holding seconds when exit_time is present
            if ($model->exit_time && $model->entry_time) {
                $model->holding_seconds = $model->exit_time->diffInSeconds($model->entry_time);
            }

            // Auto-calculate P&L if both prices exist
            if ($model->entry_price && $model->exit_price && $model->quantity) {
                $multiplier = $model->direction === 'long' ? 1 : -1;
                $gross = ($model->exit_price - $model->entry_price) * $model->quantity * $multiplier;
                $model->profit_loss = $gross - ($model->commission ?? 0) - ($model->swap ?? 0);

                if ($model->entry_price > 0) {
                    $model->profit_loss_percent = ($model->profit_loss / ($model->entry_price * $model->quantity)) * 100;
                }
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty(['entry_time', 'exit_time'])) {
                if ($model->exit_time && $model->entry_time) {
                    $model->holding_seconds = $model->exit_time->diffInSeconds($model->entry_time);
                }
            }

            if ($model->isDirty(['entry_price', 'exit_price', 'quantity', 'commission', 'swap'])) {
                if ($model->entry_price && $model->exit_price && $model->quantity) {
                    $multiplier = $model->direction === 'long' ? 1 : -1;
                    $gross = ($model->exit_price - $model->entry_price) * $model->quantity * $multiplier;
                    $model->profit_loss = $gross - ($model->commission ?? 0) - ($model->swap ?? 0);

                    if ($model->entry_price > 0) {
                        $model->profit_loss_percent = ($model->profit_loss / ($model->entry_price * $model->quantity)) * 100;
                    }
                }
            }
        });
    }

    // ====================================================================
    // Relationships
    // ====================================================================
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function challenge(): BelongsTo
    {
        return $this->belongsTo(Challenge::class); // create Challenge model if needed
    }



    // ====================================================================
    // Accessors & Mutators
    // ====================================================================
    public function getDirectionBadgeAttribute(): string
    {
        return $this->direction === 'long'
            ? '<span class="badge bg-success">LONG</span>'
            : '<span class="badge bg-danger">SHORT</span>';
    }

    public function getProfitLossBadgeAttribute(): string
    {
        if ($this->profit_loss > 0) {
            return '<span class="badge bg-success">+' . number_format($this->profit_loss, 2) . '</span>';
        } elseif ($this->profit_loss < 0) {
            return '<span class="badge bg-danger">' . number_format($this->profit_loss, 2) . '</span>';
        }
        return '<span class="badge bg-secondary">0.00</span>';
    }

    public function getHoldingTimeAttribute(): string
    {
        if (!$this->holding_seconds) {
            return '-';
        }

        $hours = floor($this->holding_seconds / 3600);
        $minutes = floor(($this->holding_seconds % 3600) / 60);
        $seconds = $this->holding_seconds % 60;

        if ($hours > 0) {
            return sprintf('%dh %dm', $hours, $minutes);
        }
        if ($minutes > 0) {
            return sprintf('%dm %ds', $minutes, $seconds);
        }
        return $seconds . 's';
    }

    // ====================================================================
    // Scopes
    // ====================================================================
    public function scopeLong($query)
    {
        return $query->where('direction', 'long');
    }

    public function scopeShort($query)
    {
        return $query->where('direction', 'short');
    }

    public function scopeWinning($query)
    {
        return $query->where('profit_loss', '>', 0);
    }

    public function scopeLosing($query)
    {
        return $query->where('profit_loss', '<', 0);
    }

    public function scopeLive($query)
    {
        return $query->where('is_paper', false);
    }

    public function scopePaper($query)
    {
        return $query->where('is_paper', true);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('entry_time', today());
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('entry_time', now()->month)->whereYear('entry_time', now()->year);
    }
}
