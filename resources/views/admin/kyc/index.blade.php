@extends('layout.master')

@section('title', 'KYC Applications Management')

@section('main_content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-id-card-alt me-2"></i>KYC Applications
        </h1>
        <div class="d-flex gap-2">
            <a href="{{ route('kyc.export', request()->all()) }}" class="btn btn-success">
                <i class="fas fa-file-export me-2"></i>Export CSV
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Applications
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Review
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Approved
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['approved'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Rejected
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['rejected'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
            @if(request()->hasAny(['status', 'search', 'from_date', 'to_date']))
                <a href="{{ route('kyc.index') }}" class="btn btn-sm btn-outline-secondary">
                    Clear Filters
                </a>
            @endif
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('kyc.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status" class="small">Status</label>
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="">All Status</option>
                                <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="from_date" class="small">From Date</label>
                            <input type="date" name="from_date" id="from_date"
                                   class="form-control form-control-sm"
                                   value="{{ request('from_date') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="to_date" class="small">To Date</label>
                            <input type="date" name="to_date" id="to_date"
                                   class="form-control form-control-sm"
                                   value="{{ request('to_date') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="search" class="small">Search</label>
                            <input type="text" name="search" id="search"
                                   class="form-control form-control-sm"
                                   placeholder="Name, PAN, Mobile..."
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fas fa-filter me-1"></i>Apply Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Applications Table -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">KYC Applications</h6>
            <div class="d-flex gap-2 align-items-center">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="selectAll">
                    <label class="form-check-label small" for="selectAll">Select All</label>
                </div>
                <select id="bulkAction" class="form-control form-control-sm w-auto">
                    <option value="">Bulk Actions</option>
                    <option value="approve">Approve Selected</option>
                    <option value="reject">Reject Selected</option>
                    <option value="delete">Delete Selected</option>
                </select>
                <button type="button" class="btn btn-sm btn-primary" onclick="applyBulkAction()">
                    Apply
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="kycTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="30">
                                <input type="checkbox" id="checkAll">
                            </th>
                            <th>ID</th>
                            <th>Applicant</th>
                            <th>PAN</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kycs as $kyc)
                            <tr>
                                <td>
                                    <input type="checkbox" class="row-checkbox" value="{{ $kyc->id }}">
                                </td>
                                <td>{{ $kyc->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle-sm bg-primary text-white me-2">
                                            {{ substr($kyc->first_name, 0, 1) }}{{ substr($kyc->last_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <strong>{{ $kyc->first_name }} {{ $kyc->last_name }}</strong>
                                            <div class="small text-muted">
                                                User: {{ $kyc->user->username ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <code class="text-uppercase">{{ $kyc->pan_number }}</code>
                                    <div class="small text-muted">Aadhaar: {{ $kyc->aadhaar_number }}</div>
                                </td>
                                <td>
                                    <div>{{ $kyc->mobile_number }}</div>
                                    <div class="small text-muted">{{ $kyc->email }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $kyc->status_color }}">
                                        {{ ucfirst($kyc->status) }}
                                    </span>
                                    @if($kyc->trading_account_number)
                                        <div class="small mt-1">
                                            <strong>Trd:</strong> {{ $kyc->trading_account_number }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div>{{ $kyc->submitted_at->format('d M Y') }}</div>
                                    <div class="small text-muted">{{ $kyc->submitted_at->format('h:i A') }}</div>
                                    @if($kyc->verified_at)
                                        <div class="small text-success">
                                            Verified: {{ $kyc->verified_at->format('d M') }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('kyc.show', $kyc) }}"
                                           class="btn btn-sm btn-info"
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if($kyc->status == 'submitted')
                                            <button type="button"
                                                    class="btn btn-sm btn-success"
                                                    onclick="approveSingle({{ $kyc->id }})"
                                                    title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>

                                            <button type="button"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="rejectSingle({{ $kyc->id }})"
                                                    title="Reject">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif

                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="deleteSingle({{ $kyc->id }})"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No KYC applications found</h5>
                                    @if(request()->hasAny(['status', 'search', 'from_date', 'to_date']))
                                        <a href="{{ route('kyc.index') }}" class="btn btn-sm btn-primary mt-2">
                                            Clear filters
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="small text-muted">
                    Showing {{ $kycs->firstItem() }} to {{ $kycs->lastItem() }} of {{ $kycs->total() }} entries
                </div>
                <div>
                    {{ $kycs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve KYC Application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success">
                    <i class="fas fa-info-circle me-2"></i>
                    Approving will generate trading & demat accounts for the user.
                </div>
                <form id="approveForm">
                    @csrf
                    <div class="mb-3">
                        <label for="approveRemarks" class="form-label">Remarks (Optional)</label>
                        <textarea class="form-control" id="approveRemarks" name="remarks"
                                  rows="3" placeholder="Add any remarks..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="confirmApprove()">Approve</button>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject KYC Application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Please provide a reason for rejection. The user will be notified.
                </div>
                <form id="rejectForm">
                    @csrf
                    <div class="mb-3">
                        <label for="rejectionReason" class="form-label required">Reason for Rejection</label>
                        <textarea class="form-control" id="rejectionReason" name="rejection_reason"
                                  rows="4" placeholder="Please specify why this KYC is being rejected..."
                                  required></textarea>
                        <div class="form-text small">Minimum 10 characters required</div>
                    </div>
                    <div class="mb-3">
                        <label for="rejectRemarks" class="form-label">Internal Remarks (Optional)</label>
                        <textarea class="form-control" id="rejectRemarks" name="remarks"
                                  rows="2" placeholder="Internal notes..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmReject()">Reject</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete KYC Application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    This will permanently delete the KYC application and all uploaded documents.
                    This action cannot be undone!
                </div>
                <p>Are you sure you want to delete this KYC application?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete Permanently</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .avatar-circle-sm {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
    }

    .badge.bg-submitted { background-color: #6c757d; }
    .badge.bg-approved { background-color: #198754; }
    .badge.bg-rejected { background-color: #dc3545; }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }

    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Initialize Bootstrap modals
    let currentKycId = null;
    let approveModal = null;
    let rejectModal = null;
    let deleteModal = null;

    // Wait for DOM to load
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Bootstrap modals
        approveModal = new bootstrap.Modal(document.getElementById('approveModal'));
        rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
        deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

        // Checkbox handling
        document.getElementById('checkAll').addEventListener('change', function() {
            document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = this.checked);
        });

        document.getElementById('selectAll').addEventListener('change', function() {
            document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = this.checked);
        });

        // Auto-select date range for filters
        const urlParams = new URLSearchParams(window.location.search);
        if (!urlParams.has('from_date') && !urlParams.has('to_date')) {
            // Set default to last 30 days
            const today = new Date();
            const thirtyDaysAgo = new Date();
            thirtyDaysAgo.setDate(today.getDate() - 30);

            document.getElementById('from_date').value = thirtyDaysAgo.toISOString().split('T')[0];
            document.getElementById('to_date').value = today.toISOString().split('T')[0];
        }
    });

    // Get CSRF token
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    // Bulk actions
    async function applyBulkAction() {
        const action = document.getElementById('bulkAction').value;
        const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked'))
                               .map(cb => cb.value);

        if (!action) {
            Swal.fire('Error', 'Please select an action', 'error');
            return;
        }

        if (selectedIds.length === 0) {
            Swal.fire('Error', 'Please select at least one application', 'error');
            return;
        }

        if (action === 'delete') {
            const result = await Swal.fire({
                title: 'Are you sure?',
                text: 'This will permanently delete selected applications!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete!'
            });

            if (!result.isConfirmed) {
                return;
            }
        }

        try {
            const response = await fetch("{{ route('kyc.bulk-action') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    action: action,
                    ids: selectedIds
                })
            });

            const data = await response.json();

            if (data.success) {
                await Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    confirmButtonColor: '#198754'
                });
                location.reload();
            } else {
                throw new Error(data.message || 'Operation failed');
            }
        } catch (error) {
            Swal.fire('Error', error.message || 'Something went wrong', 'error');
        }
    }

    // Single approve
    function approveSingle(id) {
        currentKycId = id;
        approveModal.show();
    }

    async function confirmApprove() {
        const remarks = document.getElementById('approveRemarks').value;

        try {
            const response = await fetch(`/kyc/${currentKycId}/approve`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    remarks: remarks,
                    _token: getCsrfToken()
                })
            });

            const data = await response.json();

            if (data.success) {
                await Swal.fire({
                    icon: 'success',
                    title: 'Approved!',
                    text: data.message,
                    confirmButtonColor: '#198754'
                });
                location.reload();
            } else {
                throw new Error(data.message || 'Approval failed');
            }
        } catch (error) {
            Swal.fire('Error', error.message || 'Something went wrong', 'error');
        }

        approveModal.hide();
    }

    // Single reject
    function rejectSingle(id) {
        currentKycId = id;
        document.getElementById('rejectionReason').value = '';
        document.getElementById('rejectRemarks').value = '';
        rejectModal.show();
    }

    async function confirmReject() {
        const reason = document.getElementById('rejectionReason').value;
        const remarks = document.getElementById('rejectRemarks').value;

        if (!reason || reason.trim().length < 10) {
            Swal.fire('Warning', 'Please provide a valid rejection reason (minimum 10 characters)', 'warning');
            return;
        }

        try {
            const response = await fetch(`/kyc/${currentKycId}/reject`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    rejection_reason: reason,
                    remarks: remarks,
                    _token: getCsrfToken()
                })
            });

            const data = await response.json();

            if (data.success) {
                await Swal.fire({
                    icon: 'success',
                    title: 'Rejected!',
                    text: data.message,
                    confirmButtonColor: '#198754'
                });
                location.reload();
            } else {
                throw new Error(data.message || 'Rejection failed');
            }
        } catch (error) {
            Swal.fire('Error', error.message || 'Something went wrong', 'error');
        }

        rejectModal.hide();
    }

    // Single delete
    function deleteSingle(id) {
        currentKycId = id;
        deleteModal.show();
    }

    async function confirmDelete() {
        try {
            const response = await fetch(`/kyc/${currentKycId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (data.success) {
                await Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: data.message,
                    confirmButtonColor: '#198754'
                });
                location.reload();
            } else {
                throw new Error(data.message || 'Deletion failed');
            }
        } catch (error) {
            Swal.fire('Error', error.message || 'Something went wrong', 'error');
        }

        deleteModal.hide();
    }
</script>
@endsection
