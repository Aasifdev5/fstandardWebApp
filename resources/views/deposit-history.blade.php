@extends('user-master')

@section('title', 'Deposit History')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 fw-800 text-light mb-1">
                        <i class="fas fa-history text-primary me-2"></i>Deposit History
                    </h1>
                    <p class="text-light mb-0">Track all your funding account deposits and evaluations</p>
                </div>
                <div class="d-flex gap-2">
                    <div class="stat-card bg-primary text-white rounded-3 p-3 text-center shadow-sm">
                        <div class="stat-value fw-bold fs-4">{{ $purchases->count() }}</div>
                        <div class="stat-label fs-7 opacity-90">Total Deposits</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($purchases->isEmpty())
    <!-- Empty State -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body text-center py-5">
                    <div class="empty-state-illustration mb-4">
                        <div class="position-relative">
                            <div class="circle-animation">
                                <div class="wave"></div>
                                <div class="wave delay-1"></div>
                                <div class="wave delay-2"></div>
                            </div>
                            <i class="fas fa-wallet fa-4x text-primary position-relative z-1"></i>
                        </div>
                    </div>
                    <h3 class="fw-700 text-dark mb-3">No Deposits Yet</h3>
                    <p class="text-muted fs-5 mb-4">Start your trading journey by purchasing an evaluation account</p>
                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg px-4 py-3 rounded-pill shadow-sm">
                        <i class="fas fa-rocket me-2"></i>Start First Challenge
                    </a>
                    <div class="mt-4">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Your deposit history will appear here after making your first purchase
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Stats Overview -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-light shadow-sm rounded-4 mb-4">
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper bg-success-subtle rounded-3 p-3 me-3">
                                    <i class="fas fa-check-circle text-success fs-4"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-3">{{ $purchases->where('status', 'approved')->count() }}</div>
                                    <div class="text-muted">Active Evaluations</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper bg-warning-subtle rounded-3 p-3 me-3">
                                    <i class="fas fa-clock text-warning fs-4"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-3">{{ $purchases->where('status', 'pending')->count() }}</div>
                                    <div class="text-muted">Pending Deposits</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper bg-info-subtle rounded-3 p-3 me-3">
                                    <i class="fas fa-indian-rupee-sign text-info fs-4"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-3">₹{{ number_format($purchases->sum('amount')) }}</div>
                                    <div class="text-muted">Total Invested</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper bg-primary-subtle rounded-3 p-3 me-3">
                                    <i class="fas fa-calendar-alt text-primary fs-4"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-3">{{ $purchases->count() }}</div>
                                    <div class="text-muted">All Transactions</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <!-- Card Header -->
                <div class="card-header bg-transparent border-bottom px-4 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <h5 class="fw-700 text-dark mb-0">
                                <i class="fas fa-list-ul text-primary me-2"></i>Recent Deposits
                            </h5>
                            <div class="vr"></div>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                    <i class="fas fa-filter me-1"></i>Filter
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="?status=all">All Status</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="?status=approved">Active Only</a></li>
                                    <li><a class="dropdown-item" href="?status=pending">Pending Only</a></li>
                                    <li><a class="dropdown-item" href="?status=rejected">Rejected</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm d-flex align-items-center gap-2"
                                    onclick="exportToCSV()">
                                <i class="fas fa-file-export"></i>
                                <span class="d-none d-md-inline">Export</span>
                            </button>
                            <button class="btn btn-primary btn-sm d-flex align-items-center gap-2"
                                    onclick="window.print()">
                                <i class="fas fa-print"></i>
                                <span class="d-none d-md-inline">Print</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </th>
                                    <th class="fw-600 text-dark">Plan Details</th>
                                    <th class="fw-600 text-dark">Amount</th>
                                    <th class="fw-600 text-dark">Status</th>
                                    <th class="fw-600 text-dark">Payment</th>
                                    <th class="fw-600 text-dark">MT5 Account</th>
                                    <th class="fw-600 text-dark">Date</th>
                                    <th class="fw-600 text-dark text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchases as $purchase)
                                <tr class="border-bottom" onclick="showDetails({{ $purchase->id }})" style="cursor: pointer;">
                                    <td class="ps-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" onclick="event.stopPropagation()">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="plan-icon bg-primary-subtle rounded-3 p-2">
                                                <i class="fas fa-chart-line text-primary fs-5"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark mb-1">{{ $purchase->plan->title ?? 'N/A' }}</div>
                                                <div class="text-muted fs-7">
                                                    Capital: <span class="fw-600">₹{{ number_format($purchase->plan->capital ?? 0) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-success">₹{{ number_format($purchase->amount, 2) }}</div>
                                        <div class="text-muted fs-7">
                                            Fee: ₹{{ number_format($purchase->plan->fee ?? 0) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column gap-1">
                                            {!! $purchase->status_badge !!}
                                            @if($purchase->approved_at)
                                            <small class="text-muted">{{ $purchase->approved_at->format('M d, Y') }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-light text-dark">
                                                {{ ucfirst($purchase->gateway) }}
                                            </span>
                                            @if($purchase->transaction_id)
                                            <span class="text-muted fs-7" title="Transaction ID">
                                                {{ substr($purchase->transaction_id, 0, 8) }}...
                                            </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($purchase->mt4_login)
                                        <div class="d-flex flex-column gap-1">
                                            <code class="bg-light rounded px-2 py-1">{{ $purchase->mt4_login }}</code>
                                            <div class="d-flex gap-1">
                                                <button class="btn btn-sm btn-outline-primary btn-copy btn-icon"
                                                        data-text="{{ $purchase->mt4_login }}"
                                                        title="Copy Login">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-success btn-copy btn-icon"
                                                        data-text="{{ $purchase->mt4_password }}"
                                                        title="Copy Password">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @else
                                        <span class="badge bg-light text-muted">Awaiting Assignment</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $purchase->created_at->format('d M') }}</div>
                                        <div class="text-muted fs-7">{{ $purchase->created_at->format('h:i A') }}</div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group" role="group" onclick="event.stopPropagation()">
                                            <button class="btn btn-outline-primary btn-sm btn-icon"
                                                    onclick="showDetails({{ $purchase->id }})"
                                                    title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @if($purchase->mt4_login)
                                            <a href="mt5://{{ $purchase->mt4_login }}"
                                               class="btn btn-outline-success btn-sm btn-icon"
                                               title="Connect to MT5">
                                                <i class="fas fa-plug"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="card-footer bg-transparent border-top px-4 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Showing <span class="fw-bold">{{ $purchases->count() }}</span> of
                            <span class="fw-bold">{{ $purchases->count() }}</span> deposits
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <small class="text-muted me-3">Download as:</small>
                            <button class="btn btn-sm btn-outline-secondary" onclick="exportToPDF()">
                                <i class="fas fa-file-pdf"></i> PDF
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" onclick="exportToCSV()">
                                <i class="fas fa-file-csv"></i> CSV
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header bg-gradient-primary text-white rounded-top-4 p-4">
                <div>
                    <h5 class="modal-title fw-700 mb-1">Deposit Details</h5>
                    <small class="opacity-75">Complete transaction information</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0" id="modalDetails">
                <!-- Content will be loaded here -->
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3 text-muted">Loading transaction details...</p>
                </div>
            </div>
            <div class="modal-footer border-top p-4">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Close
                </button>
                <button type="button" class="btn btn-primary" onclick="printDetails()">
                    <i class="fas fa-print me-2"></i>Print Details
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Copy Success Toast -->
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="copyToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
            <i class="fas fa-check-circle me-2"></i>
            <strong class="me-auto">Copied!</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            Text has been copied to clipboard
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Purchase data with enhanced structure
window.purchaseData = {!! json_encode(
    $purchases->map(function($purchase) {
        return [
            'id' => $purchase->id,
            'amount' => (float) $purchase->amount,
            'gateway' => $purchase->gateway,
            'transaction_id' => $purchase->transaction_id ?? '',
            'gateway_order_id' => $purchase->gateway_order_id ?? '',
            'gateway_payment_id' => $purchase->gateway_payment_id ?? '',
            'status' => $purchase->status,
            'notes' => $purchase->notes ?? '',
            'created_at' => $purchase->created_at->toDateTimeString(),
            'approved_at' => $purchase->approved_at ? $purchase->approved_at->toDateTimeString() : null,
            'mt4_login' => $purchase->mt4_login ?? '',
            'mt4_password' => $purchase->mt4_password ?? '',
            'mt4_server' => $purchase->mt4_server ?? '',
            'expires_at' => $purchase->expires_at ? $purchase->expires_at->toDateTimeString() : null,
            'plan' => $purchase->plan ? [
                'title' => $purchase->plan->title,
                'capital' => (float) $purchase->plan->capital,
                'fee' => (float) $purchase->plan->fee,
                'profit_target' => $purchase->plan->profit_target,
                'max_loss' => $purchase->plan->max_loss,
                'payout_cycle' => $purchase->plan->payout_cycle,
                'drawdown_type' => $purchase->plan->drawdown_type,
                'description' => $purchase->plan->description ?? '',
            ] : null,
            'approver' => $purchase->approver ? [
                'name' => $purchase->approver->name,
                'email' => $purchase->approver->email
            ] : null,
            'user' => $purchase->user ? [
                'name' => $purchase->user->name,
                'email' => $purchase->user->email
            ] : null,
        ];
    })->keyBy('id')
) !!};

// Initialize toast
let copyToast = null;

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap components
    copyToast = new bootstrap.Toast(document.getElementById('copyToast'));

    // Details modal
    const detailsModalElement = document.getElementById('detailsModal');
    if (detailsModalElement) {
        detailsModal = new bootstrap.Modal(detailsModalElement);
    }

    // Copy buttons functionality
    document.querySelectorAll('.btn-copy').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const text = this.getAttribute('data-text');
            if (text) {
                copyToClipboard(text);
                showCopySuccess();
            }
        });
    });

    // Add hover effects to table rows
    document.querySelectorAll('tbody tr[onclick]').forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'rgba(0, 123, 255, 0.05)';
        });
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
});

// Enhanced copy function
async function copyToClipboard(text) {
    try {
        await navigator.clipboard.writeText(text);
        return true;
    } catch (err) {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.opacity = '0';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            document.execCommand('copy');
            return true;
        } catch (err) {
            console.error('Copy failed:', err);
            return false;
        } finally {
            document.body.removeChild(textArea);
        }
    }
}

function showCopySuccess() {
    if (copyToast) {
        copyToast.show();
    }
}

// Show deposit details in modal
function showDetails(purchaseId) {
    const purchase = window.purchaseData[purchaseId];
    if (!purchase) {
        Swal.fire({
            icon: 'error',
            title: 'Not Found',
            text: 'Transaction details not found!'
        });
        return;
    }

    const plan = purchase.plan || {};
    const isActive = purchase.status === 'approved' &&
                    (!purchase.expires_at || new Date(purchase.expires_at) > new Date());

    const html = `
        <div class="row g-0">
            <!-- Left Column -->
            <div class="col-lg-6 border-end">
                <div class="p-4">
                    <!-- Plan Info Card -->
                    <div class="card bg-light border-0 shadow-sm mb-4">
                        <div class="card-header bg-light py-3">
                            <h6 class="mb-0 fw-700">
                                <i class="fas fa-chart-line text-primary me-2"></i>Plan Information
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="text-muted small">Plan Name</label>
                                    <div class="fw-bold text-dark fs-5">${plan.title || 'N/A'}</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small">Capital</label>
                                    <div class="fw-bold text-success">₹${formatIndianNumber(plan.capital)}</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small">Fee</label>
                                    <div class="fw-bold text-danger">₹${formatIndianNumber(plan.fee)}</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small">Profit Target</label>
                                    <div class="fw-bold text-success">${plan.profit_target || '0%'}</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small">Max Loss</label>
                                    <div class="fw-bold text-danger">${plan.max_loss || '0%'}</div>
                                </div>
                                <div class="col-12">
                                    <label class="text-muted small">Evaluation Period</label>
                                    <div class="fw-bold">${plan.payout_cycle || 'N/A'}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Details Card -->
                    <div class="card bg-light border-0 shadow-sm">
                        <div class="card-header bg-light py-3">
                            <h6 class="mb-0 fw-700">
                                <i class="fas fa-credit-card text-primary me-2"></i>Payment Details
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="text-muted small">Paid Amount</label>
                                    <div class="fw-bold text-success fs-4">₹${formatIndianNumber(purchase.amount)}</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small">Payment Method</label>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-primary">${getGatewayName(purchase.gateway)}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small">Transaction ID</label>
                                    <div>
                                        <code class="bg-light px-2 py-1 rounded">${purchase.transaction_id || 'N/A'}</code>
                                    </div>
                                </div>
                                ${purchase.notes ? `
                                <div class="col-12">
                                    <label class="text-muted small">Notes</label>
                                    <div class="alert alert-info py-2">${purchase.notes}</div>
                                </div>
                                ` : ''}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-6">
                <div class="p-4">
                    <!-- MT5 Account Card -->
                    <div class="card bg-light border-0 shadow-sm mb-4">
                        <div class="card-header bg-light py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-700">
                                    <i class="fas fa-server text-primary me-2"></i>MT5 Account
                                </h6>
                                ${isActive ?
                                '<span class="badge bg-success"><i class="fas fa-check me-1"></i>Active</span>' :
                                '<span class="badge bg-secondary"><i class="fas fa-clock me-1"></i>Inactive</span>'}
                            </div>
                        </div>
                        <div class="card-body">
                            ${purchase.mt4_login ? `
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="text-muted small">Login ID</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="${purchase.mt4_login}" readonly>
                                        <button class="btn btn-outline-primary" onclick="copyText('${purchase.mt4_login}')">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" value="${purchase.mt4_password}" readonly>
                                        <button class="btn btn-outline-success" onclick="copyText('${purchase.mt4_password}')">
                                            <i class="fas fa-key"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="text-muted small">Server</label>
                                    <div class="fw-bold">${purchase.mt4_server || 'Default Server'}</div>
                                </div>
                                ${purchase.expires_at ? `
                                <div class="col-12">
                                    <label class="text-muted small">Valid Until</label>
                                    <div class="fw-bold">${formatDate(purchase.expires_at)}</div>
                                </div>
                                ` : ''}
                                <div class="col-12">
                                    <div class="d-grid gap-2">
                                        <a href="mt5://${purchase.mt4_login}" class="btn btn-success">
                                            <i class="fas fa-plug me-2"></i>Connect to MT5
                                        </a>
                                    </div>
                                </div>
                            </div>
                            ` : `
                            <div class="text-center py-4">
                                <i class="fas fa-clock fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">Account Details Pending</h6>
                                <p class="small text-muted">MT5 credentials will be assigned after approval</p>
                            </div>
                            `}
                        </div>
                    </div>

                    <!-- Timeline Card -->
                    <div class="card bg-light border-0 shadow-sm">
                        <div class="card-header bg-light py-3">
                            <h6 class="mb-0 fw-700">
                                <i class="fas fa-history text-primary me-2"></i>Timeline
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item ${purchase.status === 'approved' ? 'completed' : ''}">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <div class="fw-bold">Submitted</div>
                                        <small class="text-muted">${formatDate(purchase.created_at)}</small>
                                    </div>
                                </div>
                                ${purchase.approved_at ? `
                                <div class="timeline-item completed">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <div class="fw-bold">Approved</div>
                                        <small class="text-muted">${formatDate(purchase.approved_at)}</small>
                                        ${purchase.approver ? `
                                        <div class="text-muted">By: ${purchase.approver.name}</div>
                                        ` : ''}
                                    </div>
                                </div>
                                ` : ''}
                                ${purchase.expires_at ? `
                                <div class="timeline-item ${isActive ? '' : 'completed'}">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <div class="fw-bold">${isActive ? 'Valid Until' : 'Expired'}</div>
                                        <small class="text-muted">${formatDate(purchase.expires_at)}</small>
                                    </div>
                                </div>
                                ` : ''}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.getElementById('modalDetails').innerHTML = html;
    detailsModal.show();
}

// Helper functions
function copyText(text) {
    copyToClipboard(text);
    showCopySuccess();
}

function getGatewayName(gateway) {
    const names = {
        'razorpay': 'Razorpay',
        'phonepe': 'PhonePe',
        'paypal': 'PayPal',
        'stripe': 'Stripe'
    };
    return names[gateway] || gateway?.charAt(0).toUpperCase() + gateway?.slice(1) || 'Unknown';
}

function formatDate(dateString) {
    if (!dateString) return '—';
    try {
        const date = new Date(dateString);
        return date.toLocaleString('en-IN', {
            day: 'numeric',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    } catch (e) {
        return '—';
    }
}

function formatIndianNumber(num) {
    if (num === null || num === undefined) return '0';
    return Number(num).toLocaleString('en-IN');
}

// Export functions
function exportToCSV() {
    try {
        let csv = "ID,Plan Name,Amount,Status,Payment Method,Transaction ID,MT5 Login,Created Date\n";

        Object.values(window.purchaseData).forEach(purchase => {
            csv += `${purchase.id},"${purchase.plan?.title || 'N/A'}","₹${formatIndianNumber(purchase.amount)}",${purchase.status},"${getGatewayName(purchase.gateway)}","${purchase.transaction_id}","${purchase.mt4_login}","${formatDate(purchase.created_at)}"\n`;
        });

        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = `deposits-${new Date().toISOString().split('T')[0]}.csv`;
        link.click();

        Swal.fire({
            icon: 'success',
            title: 'CSV Exported!',
            text: 'Your deposit history has been downloaded',
            toast: true,
            position: 'top-end',
            timer: 3000
        });
    } catch (error) {
        Swal.fire('Error', 'Failed to export CSV', 'error');
    }
}

function exportToPDF() {
    Swal.fire({
        icon: 'info',
        title: 'PDF Export',
        text: 'This feature will be available soon!',
    });
}

function printDetails() {
    const modalContent = document.getElementById('modalDetails').innerHTML;
    if (!modalContent) return;

    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
        <head>
            <title>Deposit Details - Print</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .print-header { text-align: center; margin-bottom: 30px; }
                .section { margin-bottom: 20px; }
                .section-title { font-weight: bold; border-bottom: 2px solid #000; padding-bottom: 5px; margin-bottom: 10px; }
                table { width: 100%; border-collapse: collapse; margin: 10px 0; }
                th, td { border: 1px solid #ddd; padding: 8px; }
                th { background-color: #f5f5f5; }
                @media print {
                    body { margin: 0; }
                }
            </style>
        </head>
        <body>
            <div class="print-header">
                <h2>Deposit Details</h2>
                <p>Printed on: ${new Date().toLocaleString()}</p>
            </div>
            ${modalContent}
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}
</script>
@endsection

@section('styles')
<style>
:root {
    --primary-color: #4361ee;
    --secondary-color: #3a0ca3;
    --success-color: #2ecc71;
    --warning-color: #f39c12;
    --danger-color: #e74c3c;
    --light-bg: #f8f9fa;
}

/* Enhanced Card Styles */
.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.rounded-4 {
    border-radius: 1rem !important;
}

/* Stat Cards */
.stat-card {
    min-width: 120px;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* Empty State Animation */
.empty-state-illustration {
    max-width: 200px;
    margin: 0 auto;
}

.circle-animation {
    position: relative;
    width: 150px;
    height: 150px;
    margin: 0 auto 30px;
}

.wave {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border: 2px solid var(--primary-color);
    border-radius: 50%;
    animation: wave 3s linear infinite;
    opacity: 0;
}

.wave.delay-1 {
    animation-delay: 1s;
}

.wave.delay-2 {
    animation-delay: 2s;
}

@keyframes wave {
    0% {
        transform: scale(0.8);
        opacity: 1;
    }
    100% {
        transform: scale(1.5);
        opacity: 0;
    }
}

/* Table Improvements */
.table-hover tbody tr {
    transition: all 0.2s ease;
}

.table-hover tbody tr:hover {
    background-color: rgba(67, 97, 238, 0.05) !important;
}

/* Icon Wrapper */
.icon-wrapper {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Badge Styles */
.badge {
    padding: 6px 12px;
    font-weight: 600;
    letter-spacing: 0.3px;
}

/* Button Improvements */
.btn-icon {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}

/* Timeline */
.timeline {
    position: relative;
    padding-left: 24px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 8px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-item.completed .timeline-marker {
    background-color: var(--success-color);
    border-color: var(--success-color);
}

.timeline-marker {
    position: absolute;
    left: -24px;
    top: 4px;
    width: 16px;
    height: 16px;
    border: 3px solid #dee2e6;
    border-radius: 50%;
    background: white;
    z-index: 1;
}

.timeline-content {
    padding-left: 16px;
}

/* Input Group Improvements */
.input-group .form-control {
    border-right: none;
}

.input-group .btn {
    border-left: none;
}

/* Responsive Improvements */
@media (max-width: 768px) {
    .stat-card {
        min-width: 100px;
    }

    .icon-wrapper {
        width: 50px;
        height: 50px;
    }

    .btn-sm {
        padding: 4px 8px;
        font-size: 12px;
    }
}

/* Scrollbar Styling */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Gradient Text */
.text-gradient {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Loading Animation */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.pulse {
    animation: pulse 2s infinite;
}
</style>
@endsection
