<?php
// app/Models/KycVerification.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KycVerification extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'pan_number',
        'aadhaar_number',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'father_name',
        'mother_name',
        'mobile_number',
        'email',
        'alternate_contact',
        'permanent_address',
        'permanent_city',
        'permanent_state',
        'permanent_pincode',
        'permanent_country',
        'correspondence_address',
        'correspondence_city',
        'correspondence_state',
        'correspondence_pincode',
        'correspondence_country',
        'same_as_permanent',
        'bank_name',
        'account_number',
        'account_holder_name',
        'ifsc_code',
        'branch_name',
        'bank_address',
        'occupation_type',
        'company_name',
        'designation',
        'annual_income',
        'income_source',
        'pan_card_path',
        'aadhaar_front_path',
        'aadhaar_back_path',
        'passport_photo_path',
        'signature_path',
        'cancelled_cheque_path',
        'address_proof_path',
        'income_proof_path',
        'status',
        'rejection_reason',
        'submitted_at',
        'verified_at',
        'verified_by',
        'demat_account_number',
        'trading_account_number',
        'dp_id',
        'client_id',
        'risk_appetite',
        'investment_experience',
        'investment_objectives',
        'politically_exposed',
        'us_citizen',
        'agree_terms',
        'agree_declaration',
        'submission_ip',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'same_as_permanent' => 'boolean',
        'annual_income' => 'decimal:2',
        'submitted_at' => 'datetime',
        'verified_at' => 'datetime',
        'politically_exposed' => 'boolean',
        'us_citizen' => 'boolean',
        'agree_terms' => 'boolean',
        'agree_declaration' => 'boolean',
    ];

    // Status Constants
    const STATUS_PENDING = 'pending';
    const STATUS_SUBMITTED = 'submitted';
    const STATUS_UNDER_REVIEW = 'under_review';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    // Gender Constants
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';
    const GENDER_OTHER = 'other';

    // Occupation Types
    const OCCUPATION_SALARIED = 'salaried';
    const OCCUPATION_BUSINESS = 'business';
    const OCCUPATION_PROFESSIONAL = 'professional';
    const OCCUPATION_HOUSEWIFE = 'housewife';
    const OCCUPATION_STUDENT = 'student';
    const OCCUPATION_RETIRED = 'retired';
    const OCCUPATION_OTHER = 'other';

    // Risk Appetite
    const RISK_LOW = 'low';
    const RISK_MODERATE = 'moderate';
    const RISK_HIGH = 'high';

    // Investment Experience
    const EXPERIENCE_BEGINNER = 'beginner';
    const EXPERIENCE_INTERMEDIATE = 'intermediate';
    const EXPERIENCE_EXPERT = 'expert';

    /**
     * Relationship with User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with Verifier
     */
    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Relationship with Rejector
     */
    public function rejector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    /**
     * Get full name
     */
    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . ($this->middle_name ? $this->middle_name . ' ' : '') . $this->last_name);
    }

    /**
     * Get masked PAN number
     */
    public function getMaskedPanAttribute(): string
    {
        if (!$this->pan_number) return '';
        return substr($this->pan_number, 0, 5) . '*****' . substr($this->pan_number, -2);
    }

    /**
     * Get masked Aadhaar number
     */
    public function getMaskedAadhaarAttribute(): string
    {
        if (!$this->aadhaar_number) return '';
        return '****-****-' . substr($this->aadhaar_number, -4);
    }

    /**
     * Get masked account number
     */
    public function getMaskedAccountNumberAttribute(): string
    {
        if (!$this->account_number) return '';
        return '****' . substr($this->account_number, -4);
    }

    /**
     * Check if KYC is approved
     */
    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }

    /**
     * Check if KYC is pending
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if KYC is under review
     */
    public function isUnderReview(): bool
    {
        return $this->status === self::STATUS_UNDER_REVIEW;
    }

    /**
     * Check if KYC is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            self::STATUS_APPROVED => 'badge-success',
            self::STATUS_PENDING => 'badge-warning',
            self::STATUS_SUBMITTED => 'badge-info',
            self::STATUS_UNDER_REVIEW => 'badge-primary',
            self::STATUS_REJECTED => 'badge-danger',
            default => 'badge-secondary',
        };
    }

    /**
     * Get status text
     */
    public function getStatusText(): string
    {
        return match($this->status) {
            self::STATUS_APPROVED => 'Approved',
            self::STATUS_PENDING => 'Pending',
            self::STATUS_SUBMITTED => 'Submitted',
            self::STATUS_UNDER_REVIEW => 'Under Review',
            self::STATUS_REJECTED => 'Rejected',
            default => 'Unknown',
        };
    }

    /**
     * Get status color (for Blade views)
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_APPROVED => 'success',
            self::STATUS_PENDING => 'warning',
            self::STATUS_SUBMITTED => 'info',
            self::STATUS_UNDER_REVIEW => 'primary',
            self::STATUS_REJECTED => 'danger',
            default => 'secondary',
        };
    }

    /**
     * Get status icon (for Blade views)
     */
    public function getStatusIconAttribute(): string
    {
        return match($this->status) {
            self::STATUS_APPROVED => 'check-circle',
            self::STATUS_PENDING => 'clock',
            self::STATUS_SUBMITTED => 'paper-plane',
            self::STATUS_UNDER_REVIEW => 'search',
            self::STATUS_REJECTED => 'times-circle',
            default => 'question-circle',
        };
    }

    /**
     * Get formatted annual income with currency
     */
    public function getFormattedAnnualIncomeAttribute(): string
    {
        if (!$this->annual_income) return '';
        return '₹ ' . number_format($this->annual_income, 0);
    }

    /**
     * Get occupation type text
     */
    public function getOccupationTextAttribute(): string
    {
        return match($this->occupation_type) {
            self::OCCUPATION_SALARIED => 'Salaried',
            self::OCCUPATION_BUSINESS => 'Business',
            self::OCCUPATION_PROFESSIONAL => 'Professional',
            self::OCCUPATION_HOUSEWIFE => 'Housewife',
            self::OCCUPATION_STUDENT => 'Student',
            self::OCCUPATION_RETIRED => 'Retired',
            self::OCCUPATION_OTHER => 'Other',
            default => 'Not specified',
        };
    }

    /**
     * Get risk appetite text
     */
    public function getRiskAppetiteTextAttribute(): string
    {
        return match($this->risk_appetite) {
            self::RISK_LOW => 'Low (Conservative)',
            self::RISK_MODERATE => 'Moderate (Balanced)',
            self::RISK_HIGH => 'High (Aggressive)',
            default => 'Not specified',
        };
    }

    /**
     * Get investment experience text
     */
    public function getInvestmentExperienceTextAttribute(): string
    {
        return match($this->investment_experience) {
            self::EXPERIENCE_BEGINNER => 'Beginner (0-2 years)',
            self::EXPERIENCE_INTERMEDIATE => 'Intermediate (2-5 years)',
            self::EXPERIENCE_EXPERT => 'Expert (5+ years)',
            default => 'Not specified',
        };
    }

    /**
     * Get document count
     */
    public function getDocumentCountAttribute(): int
    {
        $count = 0;
        $documents = [
            'pan_card_path',
            'aadhaar_front_path',
            'aadhaar_back_path',
            'passport_photo_path',
            'signature_path',
            'cancelled_cheque_path',
            'address_proof_path',
            'income_proof_path'
        ];

        foreach ($documents as $document) {
            if (!empty($this->$document)) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Scope for pending applications
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope for submitted applications
     */
    public function scopeSubmitted($query)
    {
        return $query->where('status', self::STATUS_SUBMITTED);
    }

    /**
     * Scope for approved applications
     */
    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    /**
     * Scope for rejected applications
     */
    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    /**
     * Scope for under review applications
     */
    public function scopeUnderReview($query)
    {
        return $query->where('status', self::STATUS_UNDER_REVIEW);
    }

    /**
     * Scope for search
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('first_name', 'LIKE', "%{$search}%")
              ->orWhere('last_name', 'LIKE', "%{$search}%")
              ->orWhere('pan_number', 'LIKE', "%{$search}%")
              ->orWhere('aadhaar_number', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%")
              ->orWhere('mobile_number', 'LIKE', "%{$search}%")
              ->orWhereHas('user', function($userQuery) use ($search) {
                  $userQuery->where('username', 'LIKE', "%{$search}%")
                           ->orWhere('email', 'LIKE', "%{$search}%");
              });
        });
    }

    /**
     * Get all status options for dropdown
     */
    public static function getStatusOptions(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_SUBMITTED => 'Submitted',
            self::STATUS_UNDER_REVIEW => 'Under Review',
            self::STATUS_APPROVED => 'Approved',
            self::STATUS_REJECTED => 'Rejected',
        ];
    }

    /**
     * Get all occupation options for dropdown
     */
    public static function getOccupationOptions(): array
    {
        return [
            self::OCCUPATION_SALARIED => 'Salaried',
            self::OCCUPATION_BUSINESS => 'Business',
            self::OCCUPATION_PROFESSIONAL => 'Professional',
            self::OCCUPATION_HOUSEWIFE => 'Housewife',
            self::OCCUPATION_STUDENT => 'Student',
            self::OCCUPATION_RETIRED => 'Retired',
            self::OCCUPATION_OTHER => 'Other',
        ];
    }

    /**
     * Get all risk appetite options for dropdown
     */
    public static function getRiskAppetiteOptions(): array
    {
        return [
            self::RISK_LOW => 'Low (Conservative)',
            self::RISK_MODERATE => 'Moderate (Balanced)',
            self::RISK_HIGH => 'High (Aggressive)',
        ];
    }

    /**
     * Get all investment experience options for dropdown
     */
    public static function getInvestmentExperienceOptions(): array
    {
        return [
            self::EXPERIENCE_BEGINNER => 'Beginner (0-2 years)',
            self::EXPERIENCE_INTERMEDIATE => 'Intermediate (2-5 years)',
            self::EXPERIENCE_EXPERT => 'Expert (5+ years)',
        ];
    }
}
