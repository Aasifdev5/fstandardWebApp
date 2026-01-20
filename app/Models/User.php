<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// ✅ Relationship imports (fixes Intelephense)
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'uid',
        'name',
        'username',
        'email',
        'password',
        'custom_password',
        'phone',
        'mobile_number',

        'account_balance',
        'account_type',
        'status',
        'is_active',
        'is_online',
        'last_seen',
        'ip_address',

        'membershipType',
        'membership_status',
        'membership_start_date',
        'membership_end_date',
        'renewal_due_date',
        'payment_status',
        'membership_card_number',
        'guest_access_count',

        'is_affiliate',
        'referral_code',
        'affiliate_earnings',
        'commission_rate',

        'is_system',
        'is_super_admin',
        'permissions',

        'whatsapp_number',
        'about',
        'level',
        'refer',
        'refer_date',

        'facebook',
        'instagram',
        'linkedin',
        'twitter',
        'facebook_id',
        'google_id',

        'country',
        'city',
        'address',
        'birth_date',
        'language',
        'id_number',

        'profile_photo',
        'player_id',
        'fcm_token',
        'is_subscribed',

        'email_verified_at',
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date'        => 'date',
        'last_seen'         => 'datetime',
        'is_active'         => 'boolean',
        'is_online'         => 'boolean',
        'is_affiliate'      => 'boolean',
        'is_system'         => 'boolean',
        'is_super_admin'    => 'boolean',
        'is_subscribed'     => 'boolean',
    ];

    // ────────────────────────────────────────────────────────────────
    // PSYCHOMETRIC RELATIONSHIPS
    // ────────────────────────────────────────────────────────────────

    public function psychometricState()
    {
        return $this->hasOne(PsychometricState::class, 'user_id', 'id');
    }

    public function psychometricSnapshots(): HasMany
    {
        return $this->hasMany(PsychometricSnapshot::class);
    }


    public function latestExplanation()
    {
        return $this->hasOne(PsychometricExplanation::class, 'user_id', 'id')->latestOfMany();
    }
    public function latestSnapshot()
    {
        // This links User 'id' to 'user_id' in psychometric_snapshots
        return $this->hasOne(PsychometricSnapshot::class, 'user_id', 'id')->latestOfMany();
    }
    public function psychometricExplanations(): HasMany
    {
        return $this->hasMany(PsychometricExplanation::class);
    }

    public function getLatestPsychometricSnapshotAttribute()
    {
        return $this->psychometricSnapshots()->latest()->first();
    }

    public function getLatestExplanationAttribute()
    {
        return $this->psychometricExplanations()->latest()->first();
    }

    // ────────────────────────────────────────────────────────────────
    // TRADES & ASSISTANCE
    // ────────────────────────────────────────────────────────────────

    public function trades(): HasMany
    {
        return $this->hasMany(Trade::class);
    }

    public function openTrades(): HasMany
    {
        return $this->trades()->where('status', 'OPEN');
    }

    public function recentTrades(int $days = 30): HasMany
    {
        return $this->trades()
            ->where('created_at', '>=', now()->subDays($days))
            ->latest();
    }

    public function tradeAssistanceLogs(): HasManyThrough
    {
        return $this->hasManyThrough(
            TradeAssistanceLog::class,
            Trade::class,
            'user_id',
            'trade_id',
            'id',
            'id'
        );
    }

    public function getLatestAssistanceLogAttribute()
    {
        return $this->tradeAssistanceLogs()->latest()->first();
    }

    // ────────────────────────────────────────────────────────────────
    // CHALLENGES
    // ────────────────────────────────────────────────────────────────

    public function challenges(): HasMany
    {
        return $this->hasMany(Challenge::class);
    }

    public function activeChallenge(): HasOne
    {
        return $this->hasOne(Challenge::class)
            ->where('status', 'active')
            ->latest();
    }

    public function getCurrentChallengeAttribute()
    {
        return $this->activeChallenge()->first();
    }

    public function hasActiveChallenge(): bool
    {
        return $this->activeChallenge()->exists();
    }

    public function scopeHasActiveChallenge($query)
    {
        return $query->whereHas('challenges', fn($q) => $q->where('status', 'active'));
    }

    // ────────────────────────────────────────────────────────────────
    // FINANCIALS
    // ────────────────────────────────────────────────────────────────

    public function balance(): HasOne
    {
        return $this->hasOne(UserBalance::class);
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }

    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function planPurchases(): HasMany
    {
        return $this->hasMany(PlanPurchase::class);
    }

    public function getWalletBalanceAttribute(): float
    {
        return $this->balance?->balance ?? 0.00;
    }

    public function getAvailableBalanceAttribute(): float
    {
        return $this->balance?->available_balance ?? 0.00;
    }

    // ────────────────────────────────────────────────────────────────
    // KYC & COMMENTS
    // ────────────────────────────────────────────────────────────────

    public function kycVerification(): HasOne
    {
        return $this->hasOne(KycVerification::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // ────────────────────────────────────────────────────────────────
    // MODEL EVENTS
    // ────────────────────────────────────────────────────────────────

    protected static function booted()
    {
        static::creating(function ($user) {
            if ($user->is_affiliate && empty($user->referral_code)) {
                $user->referral_code = strtoupper(
                    substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10)
                );
            }
        });
    }
}
