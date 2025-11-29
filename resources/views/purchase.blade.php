@extends('master')
@section('title', __('Complete Purchase'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <!-- Header -->
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold text-primary mb-3">Complete Your Purchase</h1>
                <p class="lead text-muted">Secure payment • Instant activation • 24/7 Support</p>
            </div>

            <div class="card payment-card shadow-lg border-0">
                <div class="card-header bg-gradient-primary text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 fw-bold">Order Summary</h3>
                        <span class="badge bg-light text-primary fs-6">{{ $plan->title }} Plan</span>
                    </div>
                </div>

                <div class="card-body p-4">

                    <!-- Plan Details -->
                    <div class="row align-items-center mb-4">
                        <div class="col-md-8">
                            <h4 class="fw-bold text-dark">{{ $plan->title }} Plan</h4>
                            <p class="text-muted mb-2">{{ $plan->description ?? 'Premium evaluation with full access' }}</p>
                            <div class="d-flex gap-2">
                                <span class="badge bg-success">24h Review</span>
                                <span class="badge bg-info">Secure & Encrypted</span>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="price-display p-4 rounded-3">
                                <div class="h2 fw-bold text-primary mb-0">{{ $plan->fee_formatted }}</div>
                                <small class="text-muted">One-time payment</small>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Payment Form -->
                    <form action="{{ url('payment/initiate', $plan->id) }}" method="POST" id="paymentForm">
                        @csrf

                        <h5 class="fw-bold mb-4">Select Payment Method</h5>

                        <div class="row g-4 mb-4">
                            <!-- Razorpay - PRE-SELECTED + RECOMMENDED -->
                            <div class="col-md-4">
                                <input type="radio" class="btn-check" name="gateway" value="razorpay" id="razorpay" checked required>
                                <label class="gateway-option position-relative text-center p-4 rounded-4 border shadow-sm" for="razorpay">
                                    <div class="gateway-icon text-warning mb-3">
                                        <i class="fas fa-university fa-3x"></i>
                                    </div>
                                    <div class="fw-bold">Razorpay</div>
                                    <small class="text-muted d-block mb-2">UPI • Cards • Net Banking</small>
                                    <span class="badge bg-success position-absolute top-0 end-0 m-3">Recommended</span>
                                </label>
                            </div>

                            <!-- PhonePe -->
                            <div class="col-md-4">
                                <input type="radio" class="btn-check" name="gateway" value="phonepe" id="phonepe">
                                <label class="gateway-option text-center p-4 rounded-4 border shadow-sm" for="phonepe">
                                    <div class="gateway-icon text-info mb-3">
                                        <i class="fas fa-mobile-alt fa-3x"></i>
                                    </div>
                                    <div class="fw-bold">PhonePe</div>
                                    <small class="text-muted d-block">UPI • Wallet • Cards</small>
                                </label>
                            </div>

                            <!-- PayPal -->
                            <div class="col-md-4">
                                <input type="radio" class="btn-check" name="gateway" value="paypal" id="paypal">
                                <label class="gateway-option text-center p-4 rounded-4 border shadow-sm" for="paypal">
                                    <div class="gateway-icon text-primary mb-3">
                                        <i class="fab fa-paypal fa-3x"></i>
                                    </div>
                                    <div class="fw-bold">PayPal</div>
                                    <small class="text-muted d-block">International • Secure</small>
                                </label>
                            </div>
                        </div>

                        <!-- Info Alert -->
                        <div class="alert alert-light border d-flex align-items-center mb-4">
                            <i class="fas fa-info-circle text-primary me-3 fs-5"></i>
                            <div>
                                <small class="text-muted">
                                    <strong>Note:</strong> After successful payment, your funded account will be activated within 24 hours.
                                    You will receive MT4/MT5 login details via email.
                                </small>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-lg w-100 py-4 fw-bold payment-btn">
                            <i class="fas fa-lock me-2"></i>
                            Proceed to Pay {{ $plan->fee_formatted }}
                            <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Trust Badges -->
            <div class="row text-center mt-5 g-4">
                <div class="col-6 col-md-3">
                    <div class="trust-item p-4 bg-white rounded-4 shadow-sm">
                        <i class="fas fa-shield-alt fa-2x text-success mb-2"></i>
                        <p class="small fw-bold mb-0">SSL Encrypted</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="trust-item p-4 bg-white rounded-4 shadow-sm">
                        <i class="fas fa-headset fa-2x text-info mb-2"></i>
                        <p class="small fw-bold mb-0">24/7 Support</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="trust-item p-4 bg-white rounded-4 shadow-sm">
                        <i class="fas fa-bolt fa-2x text-warning mb-2"></i>
                        <p class="small fw-bold mb-0">Fast Activation</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="trust-item p-4 bg-white rounded-4 shadow-sm">
                        <i class="fas fa-award fa-2x text-primary mb-2"></i>
                        <p class="small fw-bold mb-0">Trusted Firm</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    }
    .gateway-option {
        transition: all 0.3s ease;
        cursor: pointer;
        background: #fff;
    }
    .gateway-option:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.2) !important;
    }
    .btn-check:checked + .gateway-option {
        border-color: #667eea !important;
        background: linear-gradient(135deg, #f0f2ff 0%, #e6eaff 100%);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3) !important;
    }
    .payment-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 16px;
        font-size: 1.25rem;
        transition: all 0.3s ease;
    }
    .payment-btn:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.4);
    }
    .price-display {
        background: linear-gradient(135deg, #f8f9ff 0%, #eef2ff 100%);
        border-left: 5px solid #667eea;
    }
</style>

<script>
    // Fixed: Now form submits properly with loading state
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        const btn = this.querySelector('.payment-btn');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing Payment...';
        btn.disabled = true;
        // Form will submit normally — no preventDefault()
    });
</script>
@endsection
