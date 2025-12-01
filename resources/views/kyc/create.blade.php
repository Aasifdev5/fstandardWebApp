@extends('user-master')
@section('title', 'Submit KYC Verification')

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

    .progress-container {
        margin: 30px 0 40px;
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
        width: 20%;
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

    .form-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient);
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

    .form-control:disabled {
        background: rgba(255, 255, 255, 0.02);
        color: var(--text-secondary);
        cursor: not-allowed;
    }

    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org0/svg' width='16' height='16' fill='%238b949e' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
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

    .file-upload-container {
        position: relative;
        margin-top: 10px;
    }

    .file-upload-input {
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

    .preview-container {
        margin-top: 15px;
    }

    .preview-image {
        max-width: 200px;
        max-height: 150px;
        border-radius: 8px;
        border: 1px solid var(--card-border);
        margin-top: 10px;
        display: none;
    }

    .document-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--card-border);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .document-title {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .document-title i {
        color: var(--primary-color);
    }

    .document-requirements {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin-bottom: 15px;
        line-height: 1.5;
    }

    .document-example {
        font-size: 0.8rem;
        color: var(--warning-color);
        margin-top: 10px;
        padding: 8px 12px;
        background: rgba(248, 150, 30, 0.1);
        border-radius: 6px;
        border-left: 3px solid var(--warning-color);
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
        cursor: pointer;
    }

    .btn-primary-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(67, 97, 238, 0.3);
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
        cursor: pointer;
    }

    .btn-outline-light:hover {
        border-color: var(--primary-color);
        background: rgba(67, 97, 238, 0.05);
        color: var(--text-primary);
        transform: translateY(-2px);
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid var(--card-border);
    }

    .form-navigation {
        display: flex;
        gap: 15px;
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

    .error-message {
        color: var(--danger-color);
        font-size: 0.85rem;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .info-text {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin-top: 5px;
        line-height: 1.5;
    }

    .same-address-container {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--card-border);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
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

        .form-actions {
            flex-direction: column;
            gap: 15px;
        }

        .form-navigation {
            width: 100%;
            flex-direction: column;
        }
    }
</style>


@section('content')
<!-- KYC Header -->
<section class="kyc-header">
    <div class="kyc-header-content">
        <h1 class="kyc-title">
            <i class="fas fa-id-card me-3"></i>KYC Verification
        </h1>
        <p class="kyc-subtitle">
            Complete your Know Your Customer verification to start trading in Indian stock market
        </p>
    </div>
</section>

<!-- Main Container -->
<div class="main-container">
    <!-- Progress Steps -->
    <div class="progress-container">
        <div class="progress-steps">
            <div class="step active" id="step1">
                <div class="step-icon">1</div>
                <div class="step-label">Personal Info</div>
            </div>
            <div class="step" id="step2">
                <div class="step-icon">2</div>
                <div class="step-label">Address Details</div>
            </div>
            <div class="step" id="step3">
                <div class="step-icon">3</div>
                <div class="step-label">Bank Details</div>
            </div>
            <div class="step" id="step4">
                <div class="step-icon">4</div>
                <div class="step-label">Financial Info</div>
            </div>
            <div class="step" id="step5">
                <div class="step-icon">5</div>
                <div class="step-label">Documents</div>
            </div>
        </div>
        <div class="progress-bar" id="progressBar" style="width: 20%;"></div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kyc.store') }}" method="POST" enctype="multipart/form-data" id="kycForm">
        @csrf

        <!-- Step 1: Personal Information -->
        <div class="form-card step-content" id="step1Content">
            <h3 class="section-title">
                <i class="fas fa-user"></i>
                Personal Information
            </h3>

            <div class="form-grid">
                <!-- PAN Number -->
                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-id-card"></i>PAN Number
                    </label>
                    <input type="text"
                           name="pan_number"
                           class="form-control"
                           placeholder="ABCDE1234F"
                           value="{{ old('pan_number', $kyc->pan_number ?? '') }}"
                           maxlength="10"
                           required>
                    <div class="info-text">Enter your 10-digit Permanent Account Number</div>
                    @error('pan_number')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Aadhaar Number -->
                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-address-card"></i>Aadhaar Number
                    </label>
                    <input type="text"
                           name="aadhaar_number"
                           class="form-control"
                           placeholder="1234 5678 9012"
                           value="{{ old('aadhaar_number', $kyc->aadhaar_number ?? '') }}"
                           maxlength="12"
                           required>
                    <div class="info-text">Enter your 12-digit Aadhaar number</div>
                    @error('aadhaar_number')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                <!-- First Name -->
                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-user"></i>First Name
                    </label>
                    <input type="text"
                           name="first_name"
                           class="form-control"
                           placeholder="John"
                           value="{{ old('first_name', $kyc->first_name ?? auth()->user()->first_name ?? '') }}"
                           required>
                    @error('first_name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Middle Name -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user"></i>Middle Name
                    </label>
                    <input type="text"
                           name="middle_name"
                           class="form-control"
                           placeholder="Middle"
                           value="{{ old('middle_name', $kyc->middle_name ?? '') }}">
                    @error('middle_name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-user"></i>Last Name
                    </label>
                    <input type="text"
                           name="last_name"
                           class="form-control"
                           placeholder="Doe"
                           value="{{ old('last_name', $kyc->last_name ?? auth()->user()->last_name ?? '') }}"
                           required>
                    @error('last_name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                <!-- Date of Birth -->
                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-calendar"></i>Date of Birth
                    </label>
                    <input type="date"
                           name="date_of_birth"
                           class="form-control"
                           value="{{ old('date_of_birth', $kyc->date_of_birth ?? '') }}"
                           max="{{ date('Y-m-d', strtotime('-18 years')) }}"
                           required>
                    <div class="info-text">Must be 18 years or older</div>
                    @error('date_of_birth')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Gender -->
                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-venus-mars"></i>Gender
                    </label>
                    <select name="gender" class="form-select" required>
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender', $kyc->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $kyc->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender', $kyc->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                <!-- Father's Name -->
                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-male"></i>Father's Name
                    </label>
                    <input type="text"
                           name="father_name"
                           class="form-control"
                           placeholder="Father's Full Name"
                           value="{{ old('father_name', $kyc->father_name ?? '') }}"
                           required>
                    @error('father_name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Mother's Name -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-female"></i>Mother's Name
                    </label>
                    <input type="text"
                           name="mother_name"
                           class="form-control"
                           placeholder="Mother's Full Name"
                           value="{{ old('mother_name', $kyc->mother_name ?? '') }}">
                    @error('mother_name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                <!-- Mobile Number -->
                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-mobile-alt"></i>Mobile Number
                    </label>
                    <input type="tel"
                           name="mobile_number"
                           class="form-control"
                           placeholder="9876543210"
                           value="{{ old('mobile_number', $kyc->mobile_number ?? auth()->user()->phone ?? '') }}"
                           maxlength="10"
                           required>
                    @error('mobile_number')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-envelope"></i>Email Address
                    </label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           placeholder="you@example.com"
                           value="{{ old('email', $kyc->email ?? auth()->user()->email ?? '') }}"
                           required>
                    @error('email')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Alternate Contact -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-phone"></i>Alternate Contact
                    </label>
                    <input type="tel"
                           name="alternate_contact"
                           class="form-control"
                           placeholder="Alternative mobile number"
                           value="{{ old('alternate_contact', $kyc->alternate_contact ?? '') }}"
                           maxlength="10">
                    @error('alternate_contact')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-navigation">
                <button type="button" class="btn-outline-light" onclick="nextStep(2)">
                    Next: Address Details <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </div>

        <!-- Step 2: Address Details -->
        <div class="form-card step-content" id="step2Content" style="display: none;">
            <h3 class="section-title">
                <i class="fas fa-home"></i>
                Address Details
            </h3>

            <!-- Permanent Address -->
            <div class="form-section">
                <h4 class="mb-3" style="color: var(--text-primary);">
                    <i class="fas fa-map-marker-alt me-2"></i>Permanent Address
                </h4>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label required">
                            <i class="fas fa-map"></i>Full Address
                        </label>
                        <textarea name="permanent_address"
                                  class="form-control"
                                  rows="3"
                                  placeholder="House no, Street, Area"
                                  required>{{ old('permanent_address', $kyc->permanent_address ?? '') }}</textarea>
                        @error('permanent_address')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label required">
                            <i class="fas fa-city"></i>City
                        </label>
                        <input type="text"
                               name="permanent_city"
                               class="form-control"
                               placeholder="Mumbai"
                               value="{{ old('permanent_city', $kyc->permanent_city ?? '') }}"
                               required>
                        @error('permanent_city')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label required">
                            <i class="fas fa-landmark"></i>State
                        </label>
                        <select name="permanent_state" class="form-select" required>
                            <option value="">Select State</option>
                            <option value="Maharashtra" {{ old('permanent_state', $kyc->permanent_state ?? '') == 'Maharashtra' ? 'selected' : '' }}>Maharashtra</option>
                            <option value="Delhi" {{ old('permanent_state', $kyc->permanent_state ?? '') == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                            <option value="Karnataka" {{ old('permanent_state', $kyc->permanent_state ?? '') == 'Karnataka' ? 'selected' : '' }}>Karnataka</option>
                            <option value="Tamil Nadu" {{ old('permanent_state', $kyc->permanent_state ?? '') == 'Tamil Nadu' ? 'selected' : '' }}>Tamil Nadu</option>
                            <option value="Uttar Pradesh" {{ old('permanent_state', $kyc->permanent_state ?? '') == 'Uttar Pradesh' ? 'selected' : '' }}>Uttar Pradesh</option>
                            <!-- Add more Indian states -->
                        </select>
                        @error('permanent_state')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label required">
                            <i class="fas fa-map-pin"></i>PIN Code
                        </label>
                        <input type="text"
                               name="permanent_pincode"
                               class="form-control"
                               placeholder="400001"
                               value="{{ old('permanent_pincode', $kyc->permanent_pincode ?? '') }}"
                               maxlength="6"
                               required>
                        @error('permanent_pincode')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Correspondence Address -->
            <div class="form-section">
                <div class="same-address-container">
                    <div class="form-check">
                        <input type="checkbox"
                               class="form-check-input"
                               id="sameAsPermanent"
                               name="same_as_permanent"
                               value="1"
                               {{ old('same_as_permanent', $kyc->same_as_permanent ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="sameAsPermanent">
                            Correspondence address is same as permanent address
                        </label>
                    </div>
                </div>

                <h4 class="mb-3 mt-4" style="color: var(--text-primary);">
                    <i class="fas fa-mail-bulk me-2"></i>Correspondence Address
                </h4>

                <div id="correspondenceAddress" style="display: {{ old('same_as_permanent', $kyc->same_as_permanent ?? true) ? 'none' : 'block' }};">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label required">
                                <i class="fas fa-map"></i>Full Address
                            </label>
                            <textarea name="correspondence_address"
                                      class="form-control"
                                      rows="3"
                                      placeholder="House no, Street, Area">{{ old('correspondence_address', $kyc->correspondence_address ?? '') }}</textarea>
                            @error('correspondence_address')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label required">
                                <i class="fas fa-city"></i>City
                            </label>
                            <input type="text"
                                   name="correspondence_city"
                                   class="form-control"
                                   placeholder="Mumbai"
                                   value="{{ old('correspondence_city', $kyc->correspondence_city ?? '') }}">
                            @error('correspondence_city')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label required">
                                <i class="fas fa-landmark"></i>State
                            </label>
                            <select name="correspondence_state" class="form-select">
                                <option value="">Select State</option>
                                <option value="Maharashtra" {{ old('correspondence_state', $kyc->correspondence_state ?? '') == 'Maharashtra' ? 'selected' : '' }}>Maharashtra</option>
                                <option value="Delhi" {{ old('correspondence_state', $kyc->correspondence_state ?? '') == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                                <option value="Karnataka" {{ old('correspondence_state', $kyc->correspondence_state ?? '') == 'Karnataka' ? 'selected' : '' }}>Karnataka</option>
                                <option value="Tamil Nadu" {{ old('correspondence_state', $kyc->correspondence_state ?? '') == 'Tamil Nadu' ? 'selected' : '' }}>Tamil Nadu</option>
                                <option value="Uttar Pradesh" {{ old('correspondence_state', $kyc->correspondence_state ?? '') == 'Uttar Pradesh' ? 'selected' : '' }}>Uttar Pradesh</option>
                            </select>
                            @error('correspondence_state')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label required">
                                <i class="fas fa-map-pin"></i>PIN Code
                            </label>
                            <input type="text"
                                   name="correspondence_pincode"
                                   class="form-control"
                                   placeholder="400001"
                                   value="{{ old('correspondence_pincode', $kyc->correspondence_pincode ?? '') }}"
                                   maxlength="6">
                            @error('correspondence_pincode')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-navigation">
                <button type="button" class="btn-outline-light" onclick="prevStep(1)">
                    <i class="fas fa-arrow-left me-2"></i>Back: Personal Info
                </button>
                <button type="button" class="btn-outline-light" onclick="nextStep(3)">
                    Next: Bank Details <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </div>

        <!-- Step 3: Bank Details -->
        <div class="form-card step-content" id="step3Content" style="display: none;">
            <h3 class="section-title">
                <i class="fas fa-university"></i>
                Bank Details
            </h3>

            <div class="document-example">
                <i class="fas fa-info-circle me-2"></i>
                Please ensure bank details match your cancelled cheque
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-landmark"></i>Bank Name
                    </label>
                    <select name="bank_name" class="form-select" required>
                        <option value="">Select Bank</option>
                        <option value="State Bank of India" {{ old('bank_name', $kyc->bank_name ?? '') == 'State Bank of India' ? 'selected' : '' }}>State Bank of India</option>
                        <option value="HDFC Bank" {{ old('bank_name', $kyc->bank_name ?? '') == 'HDFC Bank' ? 'selected' : '' }}>HDFC Bank</option>
                        <option value="ICICI Bank" {{ old('bank_name', $kyc->bank_name ?? '') == 'ICICI Bank' ? 'selected' : '' }}>ICICI Bank</option>
                        <option value="Axis Bank" {{ old('bank_name', $kyc->bank_name ?? '') == 'Axis Bank' ? 'selected' : '' }}>Axis Bank</option>
                        <option value="Kotak Mahindra Bank" {{ old('bank_name', $kyc->bank_name ?? '') == 'Kotak Mahindra Bank' ? 'selected' : '' }}>Kotak Mahindra Bank</option>
                        <option value="Punjab National Bank" {{ old('bank_name', $kyc->bank_name ?? '') == 'Punjab National Bank' ? 'selected' : '' }}>Punjab National Bank</option>
                        <option value="Bank of Baroda" {{ old('bank_name', $kyc->bank_name ?? '') == 'Bank of Baroda' ? 'selected' : '' }}>Bank of Baroda</option>
                        <option value="Canara Bank" {{ old('bank_name', $kyc->bank_name ?? '') == 'Canara Bank' ? 'selected' : '' }}>Canara Bank</option>
                        <option value="other">Other Bank</option>
                    </select>
                    @error('bank_name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-user-tie"></i>Account Holder Name
                    </label>
                    <input type="text"
                           name="account_holder_name"
                           class="form-control"
                           placeholder="Name as per bank account"
                           value="{{ old('account_holder_name', $kyc->account_holder_name ?? '') }}"
                           required>
                    @error('account_holder_name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-credit-card"></i>Account Number
                    </label>
                    <input type="text"
                           name="account_number"
                           class="form-control"
                           placeholder="123456789012"
                           value="{{ old('account_number', $kyc->account_number ?? '') }}"
                           maxlength="18"
                           required>
                    @error('account_number')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-code"></i>IFSC Code
                    </label>
                    <input type="text"
                           name="ifsc_code"
                           class="form-control"
                           placeholder="SBIN0001234"
                           value="{{ old('ifsc_code', $kyc->ifsc_code ?? '') }}"
                           maxlength="11"
                           required>
                    <div class="info-text">Format: ABCD0123456 (4 letters + 0 + 6 digits/letters)</div>
                    @error('ifsc_code')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-code-branch"></i>Branch Name
                    </label>
                    <input type="text"
                           name="branch_name"
                           class="form-control"
                           placeholder="Main Branch, Mumbai"
                           value="{{ old('branch_name', $kyc->branch_name ?? '') }}"
                           required>
                    @error('branch_name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-map-marked-alt"></i>Bank Address
                    </label>
                    <textarea name="bank_address"
                              class="form-control"
                              rows="2"
                              placeholder="Bank branch address"
                              required>{{ old('bank_address', $kyc->bank_address ?? '') }}</textarea>
                    @error('bank_address')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-navigation">
                <button type="button" class="btn-outline-light" onclick="prevStep(2)">
                    <i class="fas fa-arrow-left me-2"></i>Back: Address Details
                </button>
                <button type="button" class="btn-outline-light" onclick="nextStep(4)">
                    Next: Financial Info <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </div>

        <!-- Step 4: Financial Information -->
        <div class="form-card step-content" id="step4Content" style="display: none;">
            <h3 class="section-title">
                <i class="fas fa-chart-line"></i>
                Financial Information
            </h3>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-briefcase"></i>Occupation Type
                    </label>
                    <select name="occupation_type" class="form-select" required>
                        <option value="">Select Occupation</option>
                        <option value="salaried" {{ old('occupation_type', $kyc->occupation_type ?? '') == 'salaried' ? 'selected' : '' }}>Salaried</option>
                        <option value="business" {{ old('occupation_type', $kyc->occupation_type ?? '') == 'business' ? 'selected' : '' }}>Business</option>
                        <option value="professional" {{ old('occupation_type', $kyc->occupation_type ?? '') == 'professional' ? 'selected' : '' }}>Professional</option>
                        <option value="housewife" {{ old('occupation_type', $kyc->occupation_type ?? '') == 'housewife' ? 'selected' : '' }}>Housewife</option>
                        <option value="student" {{ old('occupation_type', $kyc->occupation_type ?? '') == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="retired" {{ old('occupation_type', $kyc->occupation_type ?? '') == 'retired' ? 'selected' : '' }}>Retired</option>
                        <option value="other" {{ old('occupation_type', $kyc->occupation_type ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('occupation_type')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group" id="companyNameGroup">
                    <label class="form-label required">
                        <i class="fas fa-building"></i>Company/Business Name
                    </label>
                    <input type="text"
                           name="company_name"
                           class="form-control"
                           placeholder="Company Name"
                           value="{{ old('company_name', $kyc->company_name ?? '') }}">
                    @error('company_name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group" id="designationGroup">
                    <label class="form-label">
                        <i class="fas fa-user-tag"></i>Designation
                    </label>
                    <input type="text"
                           name="designation"
                           class="form-control"
                           placeholder="Your designation"
                           value="{{ old('designation', $kyc->designation ?? '') }}">
                    @error('designation')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-money-bill-wave"></i>Annual Income (₹)
                    </label>
                    <select name="annual_income" class="form-select" required>
                        <option value="">Select Annual Income</option>
                        <option value="100000" {{ old('annual_income', $kyc->annual_income ?? '') == '100000' ? 'selected' : '' }}>Less than ₹1 Lakh</option>
                        <option value="500000" {{ old('annual_income', $kyc->annual_income ?? '') == '500000' ? 'selected' : '' }}>₹1 - ₹5 Lakhs</option>
                        <option value="1000000" {{ old('annual_income', $kyc->annual_income ?? '') == '1000000' ? 'selected' : '' }}>₹5 - ₹10 Lakhs</option>
                        <option value="2500000" {{ old('annual_income', $kyc->annual_income ?? '') == '2500000' ? 'selected' : '' }}>₹10 - ₹25 Lakhs</option>
                        <option value="5000000" {{ old('annual_income', $kyc->annual_income ?? '') == '5000000' ? 'selected' : '' }}>₹25 - ₹50 Lakhs</option>
                        <option value="10000000" {{ old('annual_income', $kyc->annual_income ?? '') == '10000000' ? 'selected' : '' }}>₹50 Lakhs - ₹1 Crore</option>
                        <option value="20000000" {{ old('annual_income', $kyc->annual_income ?? '') == '20000000' ? 'selected' : '' }}>Above ₹1 Crore</option>
                    </select>
                    @error('annual_income')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label required">
                        <i class="fas fa-hand-holding-usd"></i>Source of Income
                    </label>
                    <select name="income_source" class="form-select" required>
                        <option value="">Select Income Source</option>
                        <option value="salary" {{ old('income_source', $kyc->income_source ?? '') == 'salary' ? 'selected' : '' }}>Salary</option>
                        <option value="business" {{ old('income_source', $kyc->income_source ?? '') == 'business' ? 'selected' : '' }}>Business</option>
                        <option value="investments" {{ old('income_source', $kyc->income_source ?? '') == 'investments' ? 'selected' : '' }}>Investments</option>
                        <option value="pension" {{ old('income_source', $kyc->income_source ?? '') == 'pension' ? 'selected' : '' }}>Pension</option>
                        <option value="other" {{ old('income_source', $kyc->income_source ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('income_source')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Risk Profile -->
            <div class="form-section">
                <h4 class="mb-3" style="color: var(--text-primary);">
                    <i class="fas fa-shield-alt me-2"></i>Risk Profile
                </h4>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label required">
                            <i class="fas fa-chart-pie"></i>Risk Appetite
                        </label>
                        <select name="risk_appetite" class="form-select" required>
                            <option value="">Select Risk Level</option>
                            <option value="low" {{ old('risk_appetite', $kyc->risk_appetite ?? '') == 'low' ? 'selected' : '' }}>Low (Conservative)</option>
                            <option value="moderate" {{ old('risk_appetite', $kyc->risk_appetite ?? '') == 'moderate' ? 'selected' : '' }}>Moderate (Balanced)</option>
                            <option value="high" {{ old('risk_appetite', $kyc->risk_appetite ?? '') == 'high' ? 'selected' : '' }}>High (Aggressive)</option>
                        </select>
                        <div class="info-text">Helps us suggest suitable investment options</div>
                        @error('risk_appetite')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label required">
                            <i class="fas fa-graduation-cap"></i>Investment Experience
                        </label>
                        <select name="investment_experience" class="form-select" required>
                            <option value="">Select Experience Level</option>
                            <option value="beginner" {{ old('investment_experience', $kyc->investment_experience ?? '') == 'beginner' ? 'selected' : '' }}>Beginner (0-2 years)</option>
                            <option value="intermediate" {{ old('investment_experience', $kyc->investment_experience ?? '') == 'intermediate' ? 'selected' : '' }}>Intermediate (2-5 years)</option>
                            <option value="expert" {{ old('investment_experience', $kyc->investment_experience ?? '') == 'expert' ? 'selected' : '' }}>Expert (5+ years)</option>
                        </select>
                        @error('investment_experience')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-bullseye"></i>Investment Objectives
                    </label>
                    <textarea name="investment_objectives"
                              class="form-control"
                              rows="3"
                              placeholder="e.g., Wealth creation, Retirement planning, Children's education">{{ old('investment_objectives', $kyc->investment_objectives ?? '') }}</textarea>
                    @error('investment_objectives')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-navigation">
                <button type="button" class="btn-outline-light" onclick="prevStep(3)">
                    <i class="fas fa-arrow-left me-2"></i>Back: Bank Details
                </button>
                <button type="button" class="btn-outline-light" onclick="nextStep(5)">
                    Next: Documents <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </div>

        <!-- Step 5: Documents Upload -->
        <div class="form-card step-content" id="step5Content" style="display: none;">
            <h3 class="section-title">
                <i class="fas fa-file-upload"></i>
                Documents Upload
            </h3>

            <div class="document-example">
                <i class="fas fa-info-circle me-2"></i>
                Upload clear, readable documents. Max file size: 2MB each. Accepted formats: JPG, JPEG, PNG, PDF
            </div>

            <!-- PAN Card -->
            <div class="document-card">
                <h5 class="document-title">
                    <i class="fas fa-id-card"></i>PAN Card
                </h5>
                <div class="document-requirements">
                    Upload a clear scan of your PAN card (both sides if available). Must be valid and not expired.
                </div>
                <div class="file-upload-container">
                    <input type="file"
                           name="pan_card"
                           class="file-upload-input"
                           id="panCardInput"
                           accept=".jpg,.jpeg,.png,.pdf"
                           {{ $kyc && $kyc->pan_card_path ? '' : 'required' }}>
                    <label for="panCardInput" class="file-upload-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span id="panCardLabel">Click to upload PAN Card</span>
                    </label>
                    <div class="file-info">
                        <i class="fas fa-info-circle"></i>
                        Max size: 2MB | Formats: JPG, PNG, PDF
                    </div>
                </div>
                <div class="preview-container">
                    <img id="panCardPreview" class="preview-image" src="" alt="PAN Card Preview">
                </div>
                @error('pan_card')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Aadhaar Card -->
            <div class="document-card">
                <h5 class="document-title">
                    <i class="fas fa-address-card"></i>Aadhaar Card
                </h5>
                <div class="document-requirements">
                    Upload both front and back sides of your Aadhaar card. Must be valid and not expired.
                </div>

                <!-- Aadhaar Front -->
                <div class="mb-3">
                    <label class="form-label required">
                        <i class="fas fa-id-card"></i>Aadhaar Front Side
                    </label>
                    <div class="file-upload-container">
                        <input type="file"
                               name="aadhaar_front"
                               class="file-upload-input"
                               id="aadhaarFrontInput"
                               accept=".jpg,.jpeg,.png,.pdf"
                               {{ $kyc && $kyc->aadhaar_front_path ? '' : 'required' }}>
                        <label for="aadhaarFrontInput" class="file-upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span id="aadhaarFrontLabel">Upload Aadhaar Front</span>
                        </label>
                    </div>
                    <div class="preview-container">
                        <img id="aadhaarFrontPreview" class="preview-image" src="" alt="Aadhaar Front Preview">
                    </div>
                    @error('aadhaar_front')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Aadhaar Back -->
                <div>
                    <label class="form-label required">
                        <i class="fas fa-id-card"></i>Aadhaar Back Side
                    </label>
                    <div class="file-upload-container">
                        <input type="file"
                               name="aadhaar_back"
                               class="file-upload-input"
                               id="aadhaarBackInput"
                               accept=".jpg,.jpeg,.png,.pdf"
                               {{ $kyc && $kyc->aadhaar_back_path ? '' : 'required' }}>
                        <label for="aadhaarBackInput" class="file-upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span id="aadhaarBackLabel">Upload Aadhaar Back</span>
                        </label>
                    </div>
                    <div class="preview-container">
                        <img id="aadhaarBackPreview" class="preview-image" src="" alt="Aadhaar Back Preview">
                    </div>
                    @error('aadhaar_back')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Passport Photo & Signature -->
            <div class="form-grid">
                <div class="document-card">
                    <h5 class="document-title">
                        <i class="fas fa-camera"></i>Passport Photo
                    </h5>
                    <div class="document-requirements">
                        Recent passport-sized photo with white background. Face should be clearly visible.
                    </div>
                    <div class="file-upload-container">
                        <input type="file"
                               name="passport_photo"
                               class="file-upload-input"
                               id="passportPhotoInput"
                               accept=".jpg,.jpeg,.png"
                               {{ $kyc && $kyc->passport_photo_path ? '' : 'required' }}>
                        <label for="passportPhotoInput" class="file-upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span id="passportPhotoLabel">Upload Photo</span>
                        </label>
                    </div>
                    <div class="preview-container">
                        <img id="passportPhotoPreview" class="preview-image" src="" alt="Passport Photo Preview">
                    </div>
                    @error('passport_photo')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="document-card">
                    <h5 class="document-title">
                        <i class="fas fa-signature"></i>Signature
                    </h5>
                    <div class="document-requirements">
                        Your signature on white paper with black ink. Should match bank records.
                    </div>
                    <div class="file-upload-container">
                        <input type="file"
                               name="signature"
                               class="file-upload-input"
                               id="signatureInput"
                               accept=".jpg,.jpeg,.png"
                               {{ $kyc && $kyc->signature_path ? '' : 'required' }}>
                        <label for="signatureInput" class="file-upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span id="signatureLabel">Upload Signature</span>
                        </label>
                    </div>
                    <div class="preview-container">
                        <img id="signaturePreview" class="preview-image" src="" alt="Signature Preview">
                    </div>
                    @error('signature')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Cancelled Cheque -->
            <div class="document-card">
                <h5 class="document-title">
                    <i class="fas fa-money-check-alt"></i>Cancelled Cheque
                </h5>
                <div class="document-requirements">
                    Upload a clear scan of cancelled cheque leaf. Account details should be clearly visible and match your bank details.
                </div>
                <div class="file-upload-container">
                    <input type="file"
                           name="cancelled_cheque"
                           class="file-upload-input"
                           id="cancelledChequeInput"
                           accept=".jpg,.jpeg,.png,.pdf"
                           {{ $kyc && $kyc->cancelled_cheque_path ? '' : 'required' }}>
                    <label for="cancelledChequeInput" class="file-upload-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span id="cancelledChequeLabel">Upload Cancelled Cheque</span>
                    </label>
                </div>
                <div class="preview-container">
                    <img id="cancelledChequePreview" class="preview-image" src="" alt="Cancelled Cheque Preview">
                </div>
                @error('cancelled_cheque')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Address Proof -->
            <div class="document-card">
                <h5 class="document-title">
                    <i class="fas fa-file-contract"></i>Address Proof
                </h5>
                <div class="document-requirements">
                    Upload any valid address proof (Aadhaar, Passport, Utility Bill, Bank Statement). Document should not be older than 3 months.
                </div>
                <div class="file-upload-container">
                    <input type="file"
                           name="address_proof"
                           class="file-upload-input"
                           id="addressProofInput"
                           accept=".jpg,.jpeg,.png,.pdf"
                           {{ $kyc && $kyc->address_proof_path ? '' : 'required' }}>
                    <label for="addressProofInput" class="file-upload-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span id="addressProofLabel">Upload Address Proof</span>
                    </label>
                </div>
                <div class="preview-container">
                    <img id="addressProofPreview" class="preview-image" src="" alt="Address Proof Preview">
                </div>
                @error('address_proof')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Income Proof -->
            <div class="document-card" id="incomeProofSection">
                <h5 class="document-title">
                    <i class="fas fa-file-invoice-dollar"></i>Income Proof
                </h5>
                <div class="document-requirements" id="incomeProofRequirements">
                    Required for salaried, business, and professional individuals. Upload salary slip, Form 16, or business registration.
                </div>
                <div class="file-upload-container">
                    <input type="file"
                           name="income_proof"
                           class="file-upload-input"
                           id="incomeProofInput"
                           accept=".jpg,.jpeg,.png,.pdf">
                    <label for="incomeProofInput" class="file-upload-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span id="incomeProofLabel">Upload Income Proof</span>
                    </label>
                </div>
                <div class="preview-container">
                    <img id="incomeProofPreview" class="preview-image" src="" alt="Income Proof Preview">
                </div>
                @error('income_proof')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Compliance Declarations -->
            <div class="form-section">
                <h4 class="mb-3" style="color: var(--text-primary);">
                    <i class="fas fa-shield-alt me-2"></i>Compliance Declarations
                </h4>

                <div class="form-check">
                    <input type="checkbox"
                           class="form-check-input"
                           id="politicallyExposed"
                           name="politically_exposed"
                           value="1"
                           {{ old('politically_exposed', $kyc->politically_exposed ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="politicallyExposed">
                        I am a Politically Exposed Person (PEP)
                    </label>
                </div>

                <div class="form-check">
                    <input type="checkbox"
                           class="form-check-input"
                           id="usCitizen"
                           name="us_citizen"
                           value="1"
                           {{ old('us_citizen', $kyc->us_citizen ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="usCitizen">
                        I am a US Citizen/Resident for tax purposes
                    </label>
                </div>

                <div class="form-check mt-3">
                    <input type="checkbox"
                           class="form-check-input"
                           id="agreeTerms"
                           name="agree_terms"
                           value="1"
                           {{ old('agree_terms', $kyc->agree_terms ?? false) ? 'checked' : '' }}
                           required>
                    <label class="form-check-label required" for="agreeTerms">
                        I agree to the terms and conditions of the trading platform
                    </label>
                    @error('agree_terms')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-check">
                    <input type="checkbox"
                           class="form-check-input"
                           id="agreeDeclaration"
                           name="agree_declaration"
                           value="1"
                           {{ old('agree_declaration', $kyc->agree_declaration ?? false) ? 'checked' : '' }}
                           required>
                    <label class="form-check-label required" for="agreeDeclaration">
                        I declare that all information provided is true and correct to the best of my knowledge
                    </label>
                    @error('agree_declaration')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn-outline-light" onclick="prevStep(4)">
                    <i class="fas fa-arrow-left me-2"></i>Back: Financial Info
                </button>
                <button type="submit" class="btn-primary-custom">
                    <i class="fas fa-paper-plane me-2"></i>Submit KYC Application
                </button>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let currentStep = 1;
    const totalSteps = 5;

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function () {
        updateStepDisplay();
        initializeEventListeners();
    });

    function initializeEventListeners() {
        // Same as permanent address toggle
        const sameAddressCheckbox = document.getElementById('sameAsPermanent');
        const correspondenceDiv = document.getElementById('correspondenceAddress');

        sameAddressCheckbox.addEventListener('change', function () {
            correspondenceDiv.style.display = this.checked ? 'none' : 'block';
            if (this.checked) {
                // Clear correspondence fields when checkbox is checked
                correspondenceDiv.querySelectorAll('input, textarea, select').forEach(el => {
                    if (el.type !== 'checkbox' && el.type !== 'radio') el.value = '';
                });
            }
        });

        // Occupation-based conditional fields
        const occupationSelect = document.querySelector('select[name="occupation_type"]');
        const companyNameGroup = document.getElementById('companyNameGroup');
        const designationGroup = document.getElementById('designationGroup');
        const incomeProofSection = document.getElementById('incomeProofSection');
        const incomeProofInput = document.getElementById('incomeProofInput');

        occupationSelect.addEventListener('change', function () {
            const val = this.value;
            const needsCompany = ['salaried', 'business', 'professional'].includes(val);

            companyNameGroup.style.display = needsCompany ? 'block' : 'none';
            designationGroup.style.display = needsCompany ? 'block' : 'none';

            if (needsCompany) {
                incomeProofSection.style.display = 'block';
                incomeProofInput.required = true;
                document.getElementById('incomeProofRequirements').innerHTML =
                    `Required for ${val} individuals. Upload salary slip, Form 16, ITR, or business registration.`;
            } else {
                incomeProofSection.style.display = 'block';
                incomeProofInput.required = false;
                document.getElementById('incomeProofRequirements').innerHTML =
                    `Optional for ${val === '' ? 'selected occupation' : val} individuals.`;
            }
        });

        // Trigger once on load in case of old() values
        if (occupationSelect.value) {
            occupationSelect.dispatchEvent(new Event('change'));
        }

        // File preview & label update
        setupFilePreview('panCardInput', 'panCardPreview', 'panCardLabel');
        setupFilePreview('aadhaarFrontInput', 'aadhaarFrontPreview', 'aadhaarFrontLabel');
        setupFilePreview('aadhaarBackInput', 'aadhaarBackPreview', 'aadhaarBackLabel');
        setupFilePreview('passportPhotoInput', 'passportPhotoPreview', 'passportPhotoLabel');
        setupFilePreview('signatureInput', 'signaturePreview', 'signatureLabel');
        setupFilePreview('cancelledChequeInput', 'cancelledChequePreview', 'cancelledChequeLabel');
        setupFilePreview('addressProofInput', 'addressProofPreview', 'addressProofLabel');
        setupFilePreview('incomeProofInput', 'incomeProofPreview', 'incomeProofLabel');
    }

    // File preview helper
    function setupFilePreview(inputId, previewId, labelId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        const label = document.getElementById(labelId);

        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                // Update label text
                label.textContent = file.name.length > 30 ? file.name.substring(0, 27) + '...' : file.name;

                // Show preview for images only
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.style.display = 'none';
                }
            } else {
                label.textContent = labelId.replace('Label', '').replace(/([A-Z])/g, ' $1').trim();
                preview.style.display = 'none';
            }
        });
    }

    // Navigation functions
    function nextStep(step) {
        if (validateStep(currentStep)) {
            currentStep = step;
            updateStepDisplay();
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Information',
                text: 'Please fill all required fields in the current step before proceeding.',
                background: '#161b22',
                color: '#f0f6fc',
                confirmButtonColor: '#4361ee'
            });
        }
    }

    function prevStep(step) {
        currentStep = step;
        updateStepDisplay();
    }

    function updateStepDisplay() {
        // Hide all steps
        document.querySelectorAll('.step-content').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.step').forEach(el => el.classList.remove('active', 'completed'));

        // Show current step
        document.getElementById(`step${currentStep}Content`).style.display = 'block';
        document.getElementById(`step${currentStep}`).classList.add('active');

        // Mark previous steps as completed
        for (let i = 1; i < currentStep; i++) {
            document.getElementById(`step${i}`).classList.add('completed');
        }

        // Update progress bar
        const progress = (currentStep / totalSteps) * 100;
        document.getElementById('progressBar').style.width = progress + '%';
    }

    // Basic client-side validation for current step
    function validateStep(step) {
        let isValid = true;
        const stepContent = document.getElementById(`step${step}Content`);

        stepContent.querySelectorAll('input[required], select[required], textarea[required]').forEach(field => {
            if (field.offsetParent !== null) { // field is visible
                if (!field.value.trim()) {
                    field.style.borderColor = 'var(--danger-color)';
                    isValid = false;
                } else {
                    field.style.borderColor = 'var(--card-border)';
                }
            }
        });

        // Special case: if "same as permanent" is unchecked, validate correspondence fields
        if (step === 2) {
            const sameAsPermanent = document.getElementById('sameAsPermanent').checked;
            if (!sameAsPermanent) {
                const corrFields = document.querySelectorAll('#correspondenceAddress input[required], #correspondenceAddress textarea[required], #correspondenceAddress select[required]');
                corrFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.style.borderColor = 'var(--danger-color)';
                        isValid = false;
                    } else {
                        field.style.borderColor = 'var(--card-border)';
                    }
                });
            }
        }

        // Special case: income proof required only for salaried/business/professional
        if (step === 5) {
            const occupation = document.querySelector('select[name="occupation_type"]').value;
            if (['salaried', 'business', 'professional'].includes(occupation)) {
                const incomeProof = document.getElementById('incomeProofInput');
                if (!incomeProof.files.length) {
                    incomeProof.style.borderColor = 'var(--danger-color)';
                    isValid = false;
                }
            }
        }

        // Final compliance checkboxes
        if (step === 5) {
            const agreeTerms = document.getElementById('agreeTerms');
            const agreeDeclaration = document.getElementById('agreeDeclaration');
            if (!agreeTerms.checked || !agreeDeclaration.checked) {
                isValid = false;
            }
        }

        return isValid;
    }

    // Final submission with SweetAlert confirmation
    document.getElementById('kycForm').addEventListener('submit', function (e) {
        e.preventDefault();

        if (!validateStep(5)) {
            Swal.fire({
                icon: 'error',
                title: 'Incomplete Form',
                text: 'Please complete all required fields and upload necessary documents.',
                background: '#161b22',
                color: '#f0f6fc',
                confirmButtonColor: '#4361ee'
            });
            return;
        }

        Swal.fire({
            title: 'Submit KYC Application?',
            text: 'Once submitted, you will not be able to edit the information. Please double-check everything.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Submit',
            cancelButtonText: 'Review Again',
            background: '#161b22',
            color: '#f0f6fc',
            confirmButtonColor: '#4361ee',
            cancelButtonColor: '#f72585'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Submitting...',
                    text: 'Please wait while we process your KYC application.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    background: '#161b22',
                    color: '#f0f6fc'
                });

                // Actually submit the form
                this.submit();
            }
        });
    });
</script>
