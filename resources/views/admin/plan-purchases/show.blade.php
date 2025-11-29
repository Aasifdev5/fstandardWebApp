@extends('layout.master')

@section('title', 'Purchase #' . $purchase->id . ' - Admin')

@section('main_content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #0c0c0c 0%, #1a1a2e 50%, #16213e 100%); min-height: 100vh;">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-warning">🏠 Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('plan-purchases.index') }}" class="text-warning">📦 Plan Purchases</a></li>
            <li class="breadcrumb-item active text-light">🎫 Purchase #{{ $purchase->id }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <!-- Main Card -->
            <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); border: 1px solid rgba(255,255,255,0.1) !important;">
                <div class="card-header border-bottom border-warning py-4" style="background: rgba(255,193,7,0.1);">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1 text-white">
                                <i class="fas fa-receipt me-2 text-warning"></i>
                                🎫 Purchase #{{ $purchase->id }}
                            </h3>
                            <p class="mb-0 text-warning opacity-75">🔖 Transaction ID: {{ $purchase->transaction_id }}</p>
                        </div>
                        <span class="badge fs-6 px-3 py-2
                            @if($purchase->status == 'approved') bg-success
                            @elseif($purchase->status == 'rejected') bg-danger
                            @else bg-warning text-dark @endif">
                            @if($purchase->status == 'approved') ✅
                            @elseif($purchase->status == 'rejected') ❌
                            @else ⏳ @endif
                            {{ ucfirst($purchase->status) }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Purchase Details -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 h-100" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1) !important;">
                                <div class="card-body">
                                    <h5 class="card-title text-warning mb-4">
                                        <i class="fas fa-info-circle me-2"></i>📋 Purchase Information
                                    </h5>

                                    <!-- User Details -->
                                    <div class="mb-4">
                                        <label class="small text-light opacity-75 mb-2">👤 User Details</label>
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1);">
                                            <div class="bg-warning rounded-circle p-2 me-3">
                                                <i class="fas fa-user text-dark"></i>
                                            </div>
                                            <div>
                                                <strong class="text-white">{{ $purchase->user->name }}</strong>
                                                <br>
                                                <small class="text-light opacity-75">📧 {{ $purchase->user->email }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Plan Details -->
                                    <div class="mb-4">
                                        <label class="small text-light opacity-75 mb-2">📊 Plan Details</label>
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1);">
                                            <div class="bg-info rounded-circle p-2 me-3">
                                                <i class="fas fa-chart-line text-white"></i>
                                            </div>
                                            <div>
                                                <strong class="text-white">{{ $purchase->plan->title }}</strong>
                                                <br>
                                                <span class="text-success fw-bold">💰 {{ $purchase->plan->fee_formatted }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Payment Gateway -->
                                    <div class="mb-4">
                                        <label class="small text-light opacity-75 mb-2">💳 Payment Gateway</label>
                                        <div class="p-3 rounded-3" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1);">
                                            <span class="badge text-light text-uppercase fs-6" style="background: rgba(108,92,231,0.3);">
                                                <i class="fas fa-credit-card me-1"></i>
                                                {{ $purchase->gateway }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Purchase Date -->
                                    <div class="mb-3">
                                        <label class="small text-light opacity-75 mb-2">📅 Purchase Date</label>
                                        <div class="p-3 rounded-3" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1);">
                                            <i class="fas fa-calendar text-warning me-2"></i>
                                            <span class="text-light">{{ $purchase->created_at->format('d M Y, h:i A') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card border-0 h-100" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1) !important;">
                                <div class="card-body">
                                    <h5 class="card-title text-warning mb-4">
                                        <i class="fas fa-file-invoice me-2"></i>📄 Transaction Details
                                    </h5>

                                    @if($purchase->payment_response)
                                        <label class="small text-light opacity-75 mb-2">🔍 Payment Response</label>
                                        <div class="rounded-3 p-3" style="background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); max-height: 300px; overflow-y: auto;">
                                            <pre class="text-light mb-0 small"><code>{{ json_encode($purchase->payment_response, JSON_PRETTY_PRINT) }}</code></pre>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">📭 No detailed payment response available</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons for Pending Status -->
                    @if($purchase->status === 'pending')
                    <div class="card border-warning" style="background: rgba(255,193,7,0.05); border: 1px solid rgba(255,193,7,0.3) !important;">
                        <div class="card-header py-3" style="background: rgba(255,193,7,0.1); border-bottom: 1px solid rgba(255,193,7,0.3);">
                            <h5 class="mb-0 text-warning">
                                <i class="fas fa-gavel me-2"></i>
                                ⚖️ Review & Action Required
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <form method="POST" action="{{ route('plan-purchases.approve', $purchase->id) }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label text-success">
                                                <i class="fas fa-check-circle me-1"></i>
                                                💬 Approval Notes (Optional)
                                            </label>
                                            <textarea name="notes" class="form-control" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(40,167,69,0.5); color: #fff;"
                                                      placeholder="Add optional notes for the user..."
                                                      rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-lg w-100 py-3" style="background: linear-gradient(135deg, #1a936f 0%, #0d7046 100%); border: none;">
                                            <i class="fas fa-check-double me-2"></i>
                                            ✅ Approve Purchase
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <form method="POST" action="{{ route('plan-purchases.reject', $purchase->id) }}" id="rejectForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label text-danger">
                                                <i class="fas fa-times-circle me-1"></i>
                                                🚫 Reason for Rejection
                                            </label>
                                            <textarea name="notes" class="form-control" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(220,53,69,0.5); color: #fff;"
                                                      placeholder="Please provide reason for rejection..."
                                                      rows="3" required></textarea>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-lg w-100 py-3" onclick="confirmRejection()" style="background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%); border: none;">
                                            <i class="fas fa-ban me-2"></i>
                                            ❌ Reject Purchase
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- Status Info for Non-Pending -->
                    <div class="alert border-0" style="background: @if($purchase->status == 'approved') linear-gradient(135deg, rgba(39,174,96,0.2) 0%, rgba(46,204,113,0.1) 100%) @else linear-gradient(135deg, rgba(231,76,60,0.2) 0%, rgba(192,57,43,0.1) 100%) @endif; border: 1px solid @if($purchase->status == 'approved') rgba(39,174,96,0.3) @else rgba(231,76,60,0.3) @endif;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-{{ $purchase->status == 'approved' ? 'check-circle' : 'exclamation-triangle' }} fa-2x me-3 text-{{ $purchase->status == 'approved' ? 'success' : 'danger' }}"></i>
                            <div>
                                <h5 class="mb-1 text-white">
                                    @if($purchase->status == 'approved') ✅ @else ❌ @endif
                                    Purchase {{ ucfirst($purchase->status) }}
                                </h5>
                                <p class="mb-0 text-light opacity-75">
                                    This purchase has been {{ $purchase->status }} on
                                    {{ $purchase->updated_at->format('d M Y, h:i A') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmRejection() {
    Swal.fire({
        title: 'Confirm Rejection',
        html: `
            <div class="text-center">
                <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                <h4 class="text-white">🚫 Reject This Purchase?</h4>
                <p class="text-light opacity-75">This action cannot be undone. The user will be notified about the rejection.</p>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, Reject Purchase',
        cancelButtonText: 'Cancel',
        customClass: {
            confirmButton: 'btn-lg',
            cancelButton: 'btn-lg'
        },
        background: '#1a1a2e',
        color: '#ffffff'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('rejectForm').submit();
        }
    });
}

// Add interactive effects
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effects to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.transition = 'all 0.3s ease';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Add focus effects to form elements
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('focus', function() {
            this.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.25)';
        });
        textarea.addEventListener('blur', function() {
            this.style.boxShadow = 'none';
        });
    });
});
</script>

<style>
.page-content {
    background: linear-gradient(135deg, #0c0c0c 0%, #1a1a2e 50%, #16213e 100%);
    min-height: 100vh;
    color: #ffffff;
}

.card {
    border: none;
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.breadcrumb {
    background: none;
    padding: 0;
}

.breadcrumb-item a {
    color: #ffc107 !important;
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb-item a:hover {
    color: #ffd54f !important;
}

.breadcrumb-item.active {
    color: #adb5bd !important;
}

.badge {
    font-weight: 500;
    border: 1px solid rgba(255,255,255,0.1);
}

.form-control {
    background: rgba(255,255,255,0.08) !important;
    border: 1px solid rgba(255,255,255,0.2);
    color: #ffffff !important;
    transition: all 0.3s ease;
}

.form-control:focus {
    background: rgba(255,255,255,0.12) !important;
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    color: #ffffff;
}

.form-control::placeholder {
    color: rgba(255,255,255,0.5) !important;
}

.btn-success, .btn-danger {
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-success:hover, .btn-danger:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
}

/* Custom scrollbar */
pre::-webkit-scrollbar {
    width: 8px;
    background: rgba(255,255,255,0.1);
}

pre::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.3);
    border-radius: 4px;
}

pre::-webkit-scrollbar-thumb:hover {
    background: rgba(255,255,255,0.5);
}

/* Animation for status badges */
.badge {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem !important;
    }

    .btn-lg {
        padding: 0.75rem 1rem !important;
        font-size: 0.9rem !important;
    }
}
</style>
@endsection
