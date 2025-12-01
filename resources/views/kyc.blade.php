@extends('user-master')
@section('title', 'KYC Verification')

<style>
    :root {
        --primary-color: #4361ee;
        --primary-light: #4895ef;
        --secondary-color: #3a0ca3;
        --success-color: #4cc9f0;
        --danger-color: #f72585;
        --warning-color: #f8961e;
        --dark-bg: #0d1117;
        --card-bg: #161b22;
        --card-border: #30363d;
        --text-primary: #f0f6fc;
        --text-secondary: #8b949e;
        --hover-bg: #21262d;
        --gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    }

    body {
        background: var(--dark-bg);
        min-height: 100vh;
        color: var(--text-primary);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .kyc-header {
        background: var(--gradient);
        padding: 60px 0 40px;
        position: relative;
        overflow: hidden;
        margin-bottom: 40px;
    }

    .kyc-header::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -150px;
        right: -100px;
        opacity: 0.3;
    }

    .kyc-header-content {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .kyc-title {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 15px;
        background: linear-gradient(120deg, #fff 0%, rgba(255,255,255,0.8) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 20px rgba(0,0,0,0.1);
    }

    .kyc-subtitle {
        font-size: 1.2rem;
        color: rgba(255,255,255,0.9);
        margin-bottom: 10px;
        line-height: 1.6;
    }

    .main-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .status-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .status-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient);
    }

    .status-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 2.5rem;
    }

    .status-icon.pending {
        background: rgba(248, 150, 30, 0.1);
        color: var(--warning-color);
    }

    .status-icon.submitted {
        background: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
    }

    .status-icon.approved {
        background: rgba(76, 201, 240, 0.1);
        color: var(--success-color);
    }

    .status-icon.rejected {
        background: rgba(247, 37, 133, 0.1);
        color: var(--danger-color);
    }

    .status-text {
        text-align: center;
        margin-bottom: 20px;
    }

    .status-text h4 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: var(--text-primary);
    }

    .status-text p {
        color: var(--text-secondary);
        font-size: 1rem;
        line-height: 1.6;
        max-width: 600px;
        margin: 0 auto;
    }

    .btn-primary-custom {
        background: var(--gradient);
        border: none;
        color: white;
        padding: 16px 36px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 0.5px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
    }

    .btn-primary-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(67, 97, 238, 0.3);
        color: white;
    }

    .btn-primary-custom::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.7s ease;
    }

    .btn-primary-custom:hover::before {
        left: 100%;
    }

    .btn-outline-light {
        background: transparent;
        border: 2px solid var(--card-border);
        color: var(--text-primary);
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-outline-light:hover {
        border-color: var(--primary-color);
        background: rgba(67, 97, 238, 0.05);
        color: var(--text-primary);
        transform: translateY(-2px);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }

    .info-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--card-border);
        border-radius: 12px;
        padding: 25px;
    }

    .info-title {
        color: var(--text-primary);
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-title i {
        color: var(--primary-color);
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        color: var(--text-secondary);
        font-size: 0.95rem;
    }

    .info-value {
        color: var(--text-primary);
        font-weight: 500;
        font-family: 'SF Mono', 'Monaco', monospace;
    }

    .document-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .document-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--card-border);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .document-card:hover {
        border-color: var(--primary-color);
        transform: translateY(-3px);
    }

    .document-icon {
        width: 60px;
        height: 60px;
        background: rgba(67, 97, 238, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        color: var(--primary-color);
        font-size: 1.5rem;
    }

    .document-name {
        color: var(--text-primary);
        font-weight: 500;
        margin-bottom: 10px;
        font-size: 0.95rem;
    }

    .document-status {
        font-size: 0.85rem;
        font-weight: 500;
        padding: 4px 12px;
        border-radius: 20px;
        display: inline-block;
    }

    .document-status.uploaded {
        background: rgba(76, 201, 240, 0.1);
        color: var(--success-color);
    }

    .document-status.pending {
        background: rgba(248, 150, 30, 0.1);
        color: var(--warning-color);
    }

    .form-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 30px;
    }

    .form-section {
        margin-bottom: 40px;
        padding-bottom: 30px;
        border-bottom: 1px solid var(--card-border);
    }

    .form-section:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .section-title {
        color: var(--text-primary);
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-title i {
        color: var(--primary-color);
        background: rgba(67, 97, 238, 0.1);
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        color: var(--text-primary);
        font-weight: 500;
        margin-bottom: 10px;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-label i {
        color: var(--primary-light);
        font-size: 0.9rem;
    }

    .required::after {
        content: ' *';
        color: var(--danger-color);
    }

    .form-control, .form-select {
        width: 100%;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--card-border);
        color: var(--text-primary);
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        background: rgba(255, 255, 255, 0.05);
    }

    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%238b949e' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 16px;
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .form-check-input {
        width: 20px;
        height: 20px;
        border: 2px solid var(--card-border);
        border-radius: 6px;
        background: transparent;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .form-check-label {
        color: var(--text-primary);
        font-size: 0.95rem;
        cursor: pointer;
    }

    .file-upload {
        position: relative;
        margin-top: 10px;
    }

    .file-upload input[type="file"] {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-upload-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 20px;
        background: rgba(67, 97, 238, 0.1);
        border: 2px dashed rgba(67, 97, 238, 0.3);
        border-radius: 12px;
        color: var(--primary-color);
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-upload-label:hover {
        background: rgba(67, 97, 238, 0.15);
        border-color: var(--primary-color);
    }

    .file-info {
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .preview-image {
        max-width: 200px;
        border-radius: 8px;
        border: 1px solid var(--card-border);
        margin-top: 10px;
        display: none;
    }

    .alert {
        border: none;
        border-radius: 12px;
        padding: 18px 22px;
        backdrop-filter: blur(10px);
        margin-bottom: 24px;
    }

    .alert-success {
        background: rgba(76, 201, 240, 0.1);
        color: var(--success-color);
        border-left: 4px solid var(--success-color);
    }

    .alert-danger {
        background: rgba(247, 37, 133, 0.1);
        color: var(--danger-color);
        border-left: 4px solid var(--danger-color);
    }

    .alert i {
        font-size: 1.2rem;
        margin-right: 12px;
    }

    .progress-container {
        margin: 30px 0;
    }

    .progress-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 20px;
    }

    .progress-steps::before {
        content: '';
        position: absolute;
        top: 15px;
        left: 0;
        right: 0;
        height: 2px;
        background: var(--card-border);
        z-index: 1;
    }

    .progress-bar {
        position: absolute;
        top: 15px;
        left: 0;
        height: 2px;
        background: var(--gradient);
        z-index: 2;
        transition: width 0.5s ease;
    }

    .step {
        position: relative;
        z-index: 3;
        text-align: center;
        width: 24%;
    }

    .step-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--card-bg);
        border: 2px solid var(--card-border);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        color: var(--text-secondary);
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .step.active .step-icon {
        background: var(--gradient);
        border-color: var(--primary-color);
        color: white;
    }

    .step.completed .step-icon {
        background: var(--success-color);
        border-color: var(--success-color);
        color: white;
    }

    .step-label {
        color: var(--text-secondary);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .step.active .step-label {
        color: var(--text-primary);
    }

    @media (max-width: 768px) {
        .kyc-title {
            font-size: 2.2rem;
        }

        .kyc-subtitle {
            font-size: 1.1rem;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .progress-steps {
            flex-direction: column;
            gap: 20px;
        }

        .progress-steps::before {
            display: none;
        }

        .step {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .step-icon {
            margin: 0;
        }
    }
</style>

@section('content')
@if(!$kyc)
    <!-- KYC Header -->
    <section class="kyc-header">
        <div class="kyc-header-content">
            <h1 class="kyc-title">
                <i class="fas fa-id-card me-3"></i>KYC Verification
            </h1>
            <p class="kyc-subtitle">
                Complete your identity verification to start trading in the Indian stock market
            </p>
        </div>
    </section>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Status Card -->
        <div class="status-card">
            <div class="status-icon pending">
                <i class="fas fa-file-circle-plus"></i>
            </div>
            <div class="status-text">
                <h4>KYC Not Submitted</h4>
                <p>
                    Complete your Know Your Customer (KYC) verification to unlock full trading features.
                    Indian stock market regulations require KYC for all investors.
                </p>
            </div>
            <div class="text-center">
                <a href="{{ route('kyc.create') }}" class="btn-primary-custom">
                    <i class="fas fa-play me-2"></i>Start KYC Verification
                </a>
            </div>
        </div>

        <!-- Requirements -->
        <div class="form-card">
            <h3 class="section-title">
                <i class="fas fa-clipboard-check"></i>
                Required Documents & Information
            </h3>

            <div class="info-grid">
                <div class="info-card">
                    <h5 class="info-title">
                        <i class="fas fa-id-card"></i>Identity Proof
                    </h5>
                    <div class="info-item">
                        <span class="info-label">PAN Card</span>
                        <span class="info-value">Mandatory</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Aadhaar Card</span>
                        <span class="info-value">Mandatory</span>
                    </div>
                </div>

                <div class="info-card">
                    <h5 class="info-title">
                        <i class="fas fa-home"></i>Address Proof
                    </h5>
                    <div class="info-item">
                        <span class="info-label">Aadhaar Card</span>
                        <span class="info-value">Accepted</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Passport</span>
                        <span class="info-value">Accepted</span>
                    </div>
                </div>

                <div class="info-card">
                    <h5 class="info-title">
                        <i class="fas fa-university"></i>Bank Details
                    </h5>
                    <div class="info-item">
                        <span class="info-label">Cancelled Cheque</span>
                        <span class="info-value">Required</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Bank Statement</span>
                        <span class="info-value">Optional</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@elseif($kyc->isPending() || $kyc->isUnderReview() || ($kyc->status =="submitted"))
    <!-- KYC Under Review -->
    <section class="kyc-header">
        <div class="kyc-header-content">
            <h1 class="kyc-title">
                <i class="fas fa-clock me-3"></i>KYC Under Review
            </h1>
            <p class="kyc-subtitle">
                Your KYC application is being verified by our team
            </p>
        </div>
    </section>

    <div class="main-container">
        <div class="status-card">
            <div class="status-icon {{ $kyc->status }}">
                <i class="fas fa-clock"></i>
            </div>
            <div class="status-text">
                <h4>KYC {{ ucfirst($kyc->status) }}</h4>
                <p>
                    @if($kyc->status =="submitted")
                        Your KYC application has been submitted and is pending review.
                        Our team will verify your documents within 24-48 hours.
                    @else
                        Your KYC application is currently under review.
                        You will be notified once the verification is complete.
                    @endif
                </p>
            </div>

            @if($kyc->submitted_at)
            <div class="info-grid">
                <div class="info-card">
                    <h5 class="info-title">
                        <i class="fas fa-calendar"></i>Submission Details
                    </h5>
                    <div class="info-item">
                        <span class="info-label">Submitted On</span>
                        <span class="info-value">{{ $kyc->submitted_at->format('d M Y, h:i A') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Reference ID</span>
                        <span class="info-value">KYC{{ str_pad($kyc->id, 8, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>

                <div class="info-card">
                    <h5 class="info-title">
                        <i class="fas fa-user"></i>Personal Info
                    </h5>
                    <div class="info-item">
                        <span class="info-label">Name</span>
                        <span class="info-value">{{ $kyc->full_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">PAN</span>
                        <span class="info-value">{{ $kyc->masked_pan }}</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

@elseif($kyc->isApproved())
    <!-- KYC Approved -->
    <section class="kyc-header">
        <div class="kyc-header-content">
            <h1 class="kyc-title">
                <i class="fas fa-check-circle me-3"></i>KYC Verified
            </h1>
            <p class="kyc-subtitle">
                Your KYC verification is complete. You can now start trading!
            </p>
        </div>
    </section>

    <div class="main-container">
        <div class="status-card">
            <div class="status-icon approved">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="status-text">
                <h4>KYC Approved</h4>
                <p>
                    Your KYC verification has been successfully completed and approved.
                    You now have full access to all trading features.
                </p>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <h5 class="info-title">
                        <i class="fas fa-calendar-check"></i>Verification Details
                    </h5>
                    <div class="info-item">
                        <span class="info-label">Verified On</span>
                        <span class="info-value">{{ $kyc->verified_at->format('d M Y, h:i A') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Verified By</span>
                        <span class="info-value">System Administrator</span>
                    </div>
                </div>

                <div class="info-card">
                    <h5 class="info-title">
                        <i class="fas fa-chart-line"></i>Trading Accounts
                    </h5>
                    <div class="info-item">
                        <span class="info-label">Trading Account</span>
                        <span class="info-value">{{ $kyc->trading_account_number }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Demat Account</span>
                        <span class="info-value">{{ $kyc->demat_account_number }}</span>
                    </div>
                </div>

                <div class="info-card">
                    <h5 class="info-title">
                        <i class="fas fa-user-check"></i>Personal Info
                    </h5>
                    <div class="info-item">
                        <span class="info-label">Name</span>
                        <span class="info-value">{{ $kyc->full_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">PAN</span>
                        <span class="info-value">{{ $kyc->masked_pan }}</span>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('dashboard') }}" class="btn-primary-custom me-3">
                    <i class="fas fa-chart-line me-2"></i>Start Trading
                </a>
                <a href="{{ route('kyc.show', $kyc) }}" class="btn-outline-light">
                    <i class="fas fa-eye me-2"></i>View Details
                </a>
            </div>
        </div>
    </div>

@elseif($kyc->isRejected())
    <!-- KYC Rejected -->
    <section class="kyc-header">
        <div class="kyc-header-content">
            <h1 class="kyc-title">
                <i class="fas fa-times-circle me-3"></i>KYC Rejected
            </h1>
            <p class="kyc-subtitle">
                Your KYC application requires attention
            </p>
        </div>
    </section>

    <div class="main-container">
        <div class="status-card">
            <div class="status-icon rejected">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="status-text">
                <h4>KYC Rejected</h4>
                <p>
                    Your KYC application has been rejected. Please review the reason below and resubmit.
                </p>
            </div>

            @if($kyc->rejection_reason)
            <div class="alert alert-danger mt-4">
                <i class="fas fa-exclamation-circle"></i>
                <strong>Rejection Reason:</strong> {{ $kyc->rejection_reason }}
            </div>
            @endif

            <div class="text-center mt-4">
                <a href="{{ route('kyc.create') }}" class="btn-primary-custom">
                    <i class="fas fa-redo me-2"></i>Resubmit KYC
                </a>
            </div>
        </div>
    </div>
@endif
@endsection
