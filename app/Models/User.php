<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'is_affiliate',
        'can_trade_mega',
        'account_balance',
        'status',
        'referral_code',
        'affiliate_earnings',
        'commission_rate',
        'uid',
        'name',
        'email',
        'google_id',
        'fcm_token',
        'password',
        'custom_password',
        'phone',
        'membershipType',
        'membership_status',
        'membership_start_date',
        'membership_end_date',
        'renewal_due_date',
        'payment_status',
        'membership_card_number',
        'guest_access_count',
        'last_seen',
        'is_online',
        'whatsapp_number',
        'about',
        'level',
        'refer',
        'refer_date',
        'username',
        'facebook',
        'instagram',
        'address',
        'linkedin',
        'twitter',
        'birth_date',
        'city',
        'is_active',
        'is_system',
        'email_verified_at',
        'player_id',
        'is_subscribed',
        'country',
        'id_number',
        'language',
        'is_super_admin',
        'facebook_id',
        'google_id',
        'ip_address',
        'account_type',
        'mobile_number',
        'permissions',
        'profile_photo',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public static function getUserInfo($id)
    {
        $userinfo = User::find($id);

        return $userinfo;
    }
    public function kycVerification()
    {
        return $this->hasOne(KycVerification::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    protected static function booted()
    {
        static::creating(function ($user) {
            if ($user->is_affiliate && !$user->referral_code) {
                $user->referral_code = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10));
            }
        });
    }
    /**
     * All challenges belonging to this user (past + present)
     */
    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }

    /**
     * Get the user's currently active challenge (only one active at a time)
     */
    public function activeChallenge()
    {
        return $this->hasOne(Challenge::class)
                    ->where('status', 'active')
                    ->latest();
    }

    /**
     * Get the current active challenge (magic attribute)
     * Usage: auth()->user()->current_challenge
     */
    public function getCurrentChallengeAttribute()
    {
        return $this->activeChallenge()->first();
    }

    /**
     * Scope a query to only include users who have an active challenge
     */
    public function scopeHasActiveChallenge($query)
    {
        return $query->whereHas('challenges', fn($q) => $q->where('status', 'active'));
    }

    // Bonus: Easy check in Blade / Controller
    public function hasActiveChallenge(): bool
    {
        return $this->activeChallenge()->exists();
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function trades()
    {
        return $this->hasMany(Trade::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function balance()
    {
        return $this->hasOne(UserBalance::class);
    }

    // Helper
    public function getWalletBalanceAttribute()
    {
        return $this->balance?->balance ?? 0.00;
    }

    public function getAvailableBalanceAttribute()
    {
        return $this->balance?->getAvailableBalanceAttribute() ?? 0.00;
    }
    public static function getUserFullname($id)
    {
        $userinfo = User::find($id);

        return $userinfo ? $userinfo->name : '';
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // Helper to get latest purchase with plan
    public function getLatestPurchase()
    {
        return $this->purchases()
            ->with('plan')
            ->latest()
            ->first();
    }
    public function purchases()
    {
        return $this->hasMany(PlanPurchase::class);
    }
}
