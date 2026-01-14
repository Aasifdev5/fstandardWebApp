@extends('user-master')
@section('title', 'Withdrawal Management')

@section('styles')
<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .card-header {
        border-bottom: none;
    }
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    .progress {
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.1);
    }
    .input-group-text {
        border-right: none;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }
    .form-control:focus + .input-group-text {
        border-color: #86b7fe;
        background-color: #e7f1ff;
    }
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }
    .btn-primary:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    .btn-warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border: none;
        color: white;
    }
    .badge {
        padding: 0.5em 0.8em;
        font-weight: 600;
        border-radius: 8px;
    }
    .bg-success.bg-opacity-10 {
        background-color: rgba(25, 135, 84, 0.1) !important;
    }
    .modal-content {
        border-radius: 15px;
        overflow: hidden;
        border: none;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.03);
        cursor: pointer;
    }
    /* Status badge colors */
    .badge.bg-warning {
        background: linear-gradient(135deg, #ffd166 0%, #efb366 100%) !important;
    }
    .badge.bg-success {
        background: linear-gradient(135deg, #06d6a0 0%, #06b6d4 100%) !important;
    }
    .badge.bg-danger {
        background: linear-gradient(135deg, #ef476f 0%, #ff5666 100%) !important;
    }
    .badge.bg-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
    }
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem !important;
        }
        .input-group {
            flex-wrap: nowrap;
        }
        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1 class="h3 mb-2 text-white fw-bold">Withdrawal Management</h1>
                    <p class="text-white-75 mb-0">Manage your withdrawal requests and view history</p>
                </div>
                <div class="d-flex gap-3 flex-wrap">
                    <!-- Balance Card -->
                    @if($challenge)
                    <div class="card bg-dark border-success border-opacity-25" style="min-width: 220px">
                        <div class="card-body py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-wallet text-success fs-5"></i>
                                </div>
                                <div>
                                    <p class="text-white-75 mb-1 small">Available Balance</p>
                                    <h4 class="text-white mb-0 fw-bold">₹{{ number_format($availableBalance, 2) }}</h4>
                                    <small class="text-success">Active Challenge Balance</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="card bg-dark border-warning border-opacity-25" style="min-width: 220px">
                        <div class="card-body py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-exclamation-triangle text-warning fs-5"></i>
                                </div>
                                <div>
                                    <p class="text-white-75 mb-1 small">Available Balance</p>
                                    <h4 class="text-white mb-0 fw-bold">₹0.00</h4>
                                    <small class="text-warning">No active challenge</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif


                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Withdrawal Form -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-header bg-primary bg-gradient py-3">
                    <h4 class="mb-0 text-white fw-bold">
                        <i class="fas fa-paper-plane me-2"></i>New Withdrawal Request
                    </h4>
                </div>
                <div class="card-body p-4">
                    @if($challenge)
                    <!-- Challenge Info -->
                    <div class="alert alert-info mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-trophy fa-lg me-3"></i>
                            <div>
                                <h6 class="mb-1 fw-bold text-dark">Active Challenge: {{ $challenge->challenge_name ?? 'Current Challenge' }}</h6>
                                <p class="mb-0 small text-dark">Balance available for withdrawal from your active challenge.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Withdrawal Form -->
                    <form method="POST" action="{{ route('withdraw.store') }}" id="withdrawalForm">
                        @csrf

                        <!-- Amount Input -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-white">Amount (INR) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-rupee-sign text-primary"></i>
                                </span>
                                <input type="number"
                                       name="amount"
                                       class="form-control form-control-lg"
                                       id="amountInput"
                                       min="100"
                                       max="{{ $availableBalance }}"
                                       step="100"
                                       required
                                       placeholder="Enter amount"
                                       @if(!$challenge) disabled @endif>
                                <button type="button" class="btn btn-outline-primary" id="useMaxBtn" @if(!$challenge) disabled @endif>
                                    MAX
                                </button>
                            </div>
                            <div class="mt-2">
                                <div class="form-text text-white-75 d-flex justify-content-between">
                                    <span>Minimum: ₹100</span>
                                    <span>Available: ₹{{ number_format($availableBalance, 2) }}</span>
                                </div>
                                <div class="progress mt-2" style="height: 5px;">
                                    <div class="progress-bar bg-success" id="balanceProgress" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Bank Details -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-white mb-3">
                                <i class="fas fa-university me-2 text-primary"></i>Bank Details
                            </h6>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-white">Bank Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-building text-primary"></i>
                                        </span>
                                        <input type="text"
                                               name="bank_name"
                                               class="form-control"
                                               required
                                               placeholder="Enter bank name"
                                               @if(!$challenge) disabled @endif>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-white">Account Holder <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-user text-primary"></i>
                                        </span>
                                        <input type="text"
                                               name="account_holder"
                                               class="form-control"
                                               required
                                               placeholder="Account holder name"
                                               @if(!$challenge) disabled @endif>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label fw-semibold text-white">Account Number <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-credit-card text-primary"></i>
                                        </span>
                                        <input type="text"
                                               name="account_number"
                                               class="form-control"
                                               required
                                               placeholder="Enter account number"
                                               @if(!$challenge) disabled @endif>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-white">IFSC Code <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-code text-primary"></i>
                                        </span>
                                        <input type="text"
                                               name="ifsc_code"
                                               class="form-control text-uppercase"
                                               required
                                               placeholder="IFSC"
                                               @if(!$challenge) disabled @endif>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Summary Card -->
                        <div class="card border-info mb-4 bg-info bg-opacity-10">
                            <div class="card-body">
                                <h6 class="fw-bold text-white mb-3">
                                    <i class="fas fa-calculator me-2 text-info"></i>Summary
                                </h6>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="mb-1 text-white-75">Requested Amount</p>
                                        <h5 class="text-white fw-bold" id="requestedAmount">₹0.00</h5>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-1 text-white-75">Processing Fee (2%)</p>
                                        <h5 class="text-white fw-bold" id="processingFee">₹0.00</h5>
                                    </div>
                                </div>
                                <hr class="my-2 bg-white bg-opacity-25">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="mb-1 text-white-75">You Will Receive</p>
                                        <h4 class="text-success fw-bold" id="finalAmount">₹0.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($challenge)
                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fw-bold">
                            <i class="fas fa-paper-plane me-2"></i>Submit Withdrawal Request
                        </button>
                        @else
                        <button type="button" class="btn btn-secondary btn-lg w-100 py-3 fw-bold" disabled>
                            <i class="fas fa-ban me-2"></i>No Active Challenge Available
                        </button>
                        @endif

                        <div class="alert alert-warning mt-3 text-dark">
                            <i class="fas fa-info-circle me-2"></i>
                            <small>Withdrawals are processed within 24-48 hours. A 2% processing fee applies.</small>
                        </div>
                    </form>
                    @else
                    <!-- No Active Challenge Message -->
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-trophy fa-4x text-white opacity-50"></i>
                        </div>
                        <h4 class="text-white mb-3">No Active Challenge Found</h4>
                        <p class="text-white-75 mb-4">You need to have an active challenge to make withdrawals.</p>
                        <div class="alert alert-info">
                            <i class="fas fa-lightbulb me-2"></i>
                            Start or activate a challenge to begin earning and withdrawing funds.
                        </div>
                        <a href="{{ route('challenges.index') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-arrow-right me-2"></i>View Challenges
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - Withdrawal History -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-header bg-dark bg-gradient py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-white fw-bold">
                            <i class="fas fa-history me-2"></i>Withdrawal History
                        </h4>
                        @if($withdrawals->count() > 0)
                        <span class="badge bg-light text-dark">{{ $withdrawals->count() }} requests</span>
                        @endif
                    </div>
                </div>
                <div class="card-body p-0">
                    @if ($withdrawals->isEmpty())
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fa-solid fa-money-bill-transfer fa-4x text-white opacity-50"></i>
                            </div>
                            <h4 class="text-white mb-3">No Withdrawals Yet</h4>
                            <p class="text-white-75 mb-4">You haven't made any withdrawal requests yet.</p>
                            @if($challenge)
                            <a href="{{ route('withdraw.request') }}" class="btn btn-primary">
                                Make Your First Withdrawal
                            </a>
                            @endif
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="ps-4">Date</th>
                                        <th>Amount</th>
                                        <th>Challenge</th>
                                        <th>Status</th>
                                        <th class="text-end pe-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdrawals as $wd)
                                    <tr class="border-bottom">
                                        <td class="ps-4">
                                            <div class="d-flex flex-column">
                                                <span class="fw-semibold ">{{ $wd->created_at->format('d M Y') }}</span>
                                                <small class="text-white-75">{{ $wd->created_at->format('h:i A') }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-semibold ">₹{{ number_format($wd->amount, 2) }}</span>
                                                <small class="text-success">
                                                    Net: ₹{{ number_format($wd->final_amount, 2) }}
                                                </small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info bg-opacity-25 text-info border border-info border-opacity-50">
                                                {{ $wd->challenge->challenge_name ?? 'Challenge' }}
                                            </span>
                                        </td>
                                        <td>
                                            {!! $wd->status_badge !!}
                                        </td>
                                        <td class="text-end pe-4">
                                            <button type="button"
                                                    class="btn btn-sm btn-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#detailsModal{{ $wd->id }}"
                                                    aria-label="View withdrawal details">
                                                <i class="fas fa-eye me-1"></i>Details
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Details Modal - Fixed structure -->
                                    <div class="modal fade" id="detailsModal{{ $wd->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $wd->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content bg-dark text-white">
                                                <div class="modal-header bg-dark text-white border-bottom border-secondary">
                                                    <h5 class="modal-title" id="detailsModalLabel{{ $wd->id }}">
                                                        <i class="fas fa-receipt me-2"></i>Withdrawal Details
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- Left Column: Transaction Details -->
                                                        <div class="col-md-6 mb-4">
                                                            <h6 class="fw-bold text-white mb-3">Transaction Information</h6>
                                                            <div class="mb-3">
                                                                <label class="form-label text-white-75 small">Transaction ID</label>
                                                                <p class="fw-bold text-white">#WD{{ str_pad($wd->id, 6, '0', STR_PAD_LEFT) }}</p>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-6">
                                                                    <label class="form-label text-white-75 small">Requested Amount</label>
                                                                    <p class="fw-bold text-white">₹{{ number_format($wd->amount, 2) }}</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <label class="form-label text-white-75 small">Processing Fee (2%)</label>
                                                                    <p class="fw-bold text-danger">₹{{ number_format($wd->charge, 2) }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label text-white-75 small">Final Amount</label>
                                                                <h5 class="text-success fw-bold">₹{{ number_format($wd->final_amount, 2) }}</h5>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label text-white-75 small">Request Date</label>
                                                                <p class="fw-bold text-white">{{ $wd->created_at->format('d M Y, h:i A') }}</p>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label text-white-75 small">Status</label>
                                                                <div class="d-inline-block">
                                                                    {!! $wd->status_badge !!}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Right Column: Bank Details -->
                                                        <div class="col-md-6 mb-4">
                                                            <h6 class="fw-bold text-white mb-3">Bank Details</h6>
                                                            <div class="card border-secondary">
                                                                <div class="card-body bg-dark">
                                                                    <div class="mb-3">
                                                                        <label class="form-label text-white small">Bank Name</label>
                                                                        <p class="fw-bold text-white">{{ $wd->bank_name }}</p>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label text-white small">Account Holder</label>
                                                                        <p class="fw-bold text-white">{{ $wd->account_holder }}</p>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label text-white small">Account Number</label>
                                                                        <p class="fw-bold text-white">{{ $wd->account_number }}</p>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label text-white small">IFSC Code</label>
                                                                        <p class="fw-bold text-white">{{ $wd->ifsc_code }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Challenge Information -->
                                                    <div class="row">
                                                        <div class="col-12 mb-4">
                                                            <h6 class="fw-bold text-white mb-3">Challenge Information</h6>
                                                            <div class="card bg-dark border-secondary">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label class="form-label text-white small">Challenge Name</label>
                                                                            <p class="fw-bold text-white">{{ $wd->challenge->challenge_name ?? 'N/A' }}</p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="form-label text-white small">Challenge ID</label>
                                                                            <p class="fw-bold text-white">#CH{{ str_pad($wd->challenge_id, 6, '0', STR_PAD_LEFT) }}</p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="form-label text-white small">Balance at Request</label>
                                                                            <p class="fw-bold text-white">₹{{ number_format($wd->challenge->current_balance ?? 0, 2) }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Admin Feedback -->
                                                    @if($wd->admin_feedback)
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h6 class="fw-bold text-white mb-3">Admin Feedback</h6>
                                                            <div class="alert alert-info">
                                                                <div class="d-flex">
                                                                    <i class="fas fa-comment-dots me-3 mt-1"></i>
                                                                    <div>
                                                                        <p class="mb-0 text-white">{{ $wd->admin_feedback }}</p>
                                                                        @if($wd->updated_at)
                                                                        <small class="text-white-75">
                                                                            Updated: {{ $wd->updated_at->format('d M Y, h:i A') }}
                                                                        </small>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer border-top border-secondary">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    @if($wd->status == \App\Models\Withdrawal::STATUS_PENDING)
                                                    <button type="button" class="btn btn-outline-danger">
                                                        <i class="fas fa-times me-2"></i>Cancel Request
                                                    </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if ($withdrawals->hasPages())
                        <div class="card-footer bg-dark py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-white-75">
                                    Showing {{ $withdrawals->firstItem() }} to {{ $withdrawals->lastItem() }} of {{ $withdrawals->total() }} entries
                                </div>
                                <div>
                                    {{ $withdrawals->links() }}
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const amountInput = document.getElementById('amountInput');
    const useMaxBtn = document.getElementById('useMaxBtn');
    const availableBalance = {{ $availableBalance ?? 0 }};
    const processingFeeRate = 0.02; // 2%

    const requestedAmountEl = document.getElementById('requestedAmount');
    const processingFeeEl = document.getElementById('processingFee');
    const finalAmountEl = document.getElementById('finalAmount');
    const balanceProgressEl = document.getElementById('balanceProgress');

    function updateSummary() {
        const amount = parseFloat(amountInput.value) || 0;
        const fee = amount * processingFeeRate;
        const final = amount - fee;
        const percentage = (amount / availableBalance) * 100;

        requestedAmountEl.textContent = '₹' + amount.toFixed(2);
        processingFeeEl.textContent = '₹' + fee.toFixed(2);
        finalAmountEl.textContent = '₹' + final.toFixed(2);
        balanceProgressEl.style.width = Math.min(percentage, 100) + '%';

        if (percentage > 90) {
            balanceProgressEl.classList.remove('bg-success', 'bg-warning');
            balanceProgressEl.classList.add('bg-danger');
        } else if (percentage > 70) {
            balanceProgressEl.classList.remove('bg-success', 'bg-danger');
            balanceProgressEl.classList.add('bg-warning');
        } else {
            balanceProgressEl.classList.remove('bg-warning', 'bg-danger');
            balanceProgressEl.classList.add('bg-success');
        }
    }

    if(useMaxBtn) {
        useMaxBtn.addEventListener('click', function() {
            amountInput.value = availableBalance;
            updateSummary();
        });
    }

    if(amountInput) {
        amountInput.addEventListener('input', updateSummary);
    }

    const withdrawalForm = document.getElementById('withdrawalForm');
    if(withdrawalForm) {
        withdrawalForm.addEventListener('submit', function(e) {
            const amount = parseFloat(amountInput.value);

            if (amount < 100) {
                e.preventDefault();
                showAlert('Minimum withdrawal amount is ₹100', 'warning');
                amountInput.focus();
                return;
            }

            if (amount > availableBalance) {
                e.preventDefault();
                showAlert('Amount cannot exceed available balance', 'danger');
                amountInput.focus();
                return;
            }

            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
            submitBtn.disabled = true;
        });
    }

    function showAlert(message, type = 'info') {
        const existingAlert = document.querySelector('.alert-dismissible');
        if(existingAlert) existingAlert.remove();

        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
        alert.style.zIndex = '9999';
        alert.innerHTML = `
            <i class="fas fa-${type === 'danger' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        document.body.appendChild(alert);

        setTimeout(() => {
            alert.remove();
        }, 5000);
    }

    if(availableBalance > 0) {
        updateSummary();
    }
});
</script>

@endsection
