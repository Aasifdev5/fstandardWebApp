@extends('layout.master')

@section('title', 'Plan Purchases - Admin')

@section('main_content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h1 class="h3 mb-0 text-gray-800">
                            <i class="fa fa-shopping-bag me-2 text-primary"></i>
                            Plan Purchase Requests
                        </h1>
                        @php
                            $pendingCount = $purchases->where('status', 'pending')->count();
                        @endphp

                        @if ($pendingCount > 0)
                            <div class="d-flex gap-2">
                                <span class="badge bg-primary fs-6 px-3 py-2">
                                    <i class="fa fa-clock me-1"></i>
                                    {{ $pendingCount }} Pending
                                </span>
                            </div>
                        @endif

                    </div>
                    <p class="text-muted mt-2">Manage and review all funding plan purchase requests from users</p>
                </div>
            </div>

            <!-- Flash Messages -->
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle fa-lg me-3"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">Success!</h6>
                            <p class="mb-0">{{ Session::get('success') }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            @endif

            @if (Session::has('fail') || Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle fa-lg me-3"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">Attention Required!</h6>
                            <p class="mb-0">{{ Session::get('fail') ?: Session::get('error') }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-start-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                        Total Purchases
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">{{ $purchases->count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-shopping-bag fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-start-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                        Pending Review
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">
                                        {{ $purchases->where('status', 'pending')->count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-clock fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-start-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                        Approved
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">
                                        {{ $purchases->where('status', 'approved')->count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-check-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-start-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs fw-bold text-danger text-uppercase mb-1">
                                        Rejected
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">
                                        {{ $purchases->where('status', 'rejected')->count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-times-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow border-0">
                        <div class="card-header bg-gradient-primary text-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">
                                    <i class="fas fa-list-check me-2"></i>
                                    Purchase Requests
                                </h4>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-light text-primary fs-6">
                                        <i class="fa fa-filter me-1"></i>
                                        All Requests
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <!-- Bulk Action Form -->
                            <form method="POST" action="{{ route('plan-purchases.bulk') }}" id="bulkForm">
                                @csrf
                                <div class="d-flex flex-wrap gap-3 mb-4 align-items-center p-3  rounded-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fa fa-bolt text-warning fs-5"></i>
                                        <select name="action" class="form-select border-warning" style="min-width: 200px;"
                                            required>
                                            <option value="">Choose Action...</option>
                                            <option value="approve" class="text-success">✅ Approve Selected</option>
                                            <option value="reject" class="text-danger">❌ Reject Selected</option>
                                        </select>
                                    </div>
                                    <button type="submit" id="bulkApply" class="btn btn-warning fw-bold px-4" disabled>
                                        <i class="fa fa-play-circle me-2"></i>Apply Action
                                    </button>
                                    <div class="ms-auto">
                                        <span id="selectedCount" class="badge bg-primary fs-6">0 selected</span>
                                    </div>
                                </div>

                                <div class="table-responsive rounded-3 border">
                                    <table id="basic-1" class="row-border data-table-filter table-style">
                                        <thead class="table-dark">
                                            <tr>
                                                <th width="50" class="ps-4">
                                                    <input type="checkbox" id="selectAll"
                                                        class="form-check-input shadow">
                                                </th>
                                                <th class="text-white">Purchase</th>
                                                <th class="text-white">User Details</th>
                                                <th class="text-white">Plan & Amount</th>
                                                <th class="text-white">Payment</th>
                                                <th class="text-white">Status</th>
                                                <th class="text-white">Date</th>
                                                <th class="text-white text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($purchases as $purchase)
                                                <tr class="border-bottom">
                                                    <td class="ps-4">
                                                        <input type="checkbox" name="ids[]" value="{{ $purchase->id }}"
                                                            class="form-check-input shadow purchase-checkbox">
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-primary rounded-2 p-2 me-3">
                                                                <i class="fa fa-receipt text-white fs-5"></i>
                                                            </div>
                                                            <div>
                                                                <strong class="text-dark">#{{ $purchase->id }}</strong>
                                                                <br>
                                                                <small
                                                                    class="text-muted">{{ $purchase->transaction_id }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-light rounded-circle p-2 me-3">
                                                                <i class="fa fa-user text-primary"></i>
                                                            </div>
                                                            <div>
                                                                <strong
                                                                    class="text-dark">{{ $purchase->user->name }}</strong>
                                                                <br>
                                                                <small
                                                                    class="text-muted">{{ $purchase->user->email }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-info rounded-2 p-2 me-3">
                                                                <i class="fa fa-chart-line text-white"></i>
                                                            </div>
                                                            <div>
                                                                <strong
                                                                    class="text-dark">{{ $purchase->plan->title }}</strong>
                                                                <br>
                                                                <span
                                                                    class="text-success fw-bold">{{ $purchase->plan->fee_formatted }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge bg-secondary bg-opacity-25 text-dark text-uppercase fs-6 px-3 py-2">
                                                            <i class="fa fa-credit-card me-1"></i>
                                                            {{ $purchase->gateway }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if ($purchase->status === 'pending')
                                                            <span
                                                                class="badge bg-warning bg-opacity-25 text-light fs-6 px-3 py-2">
                                                                <i class="fa fa-clock me-1"></i>Pending
                                                            </span>
                                                        @elseif($purchase->status === 'approved')
                                                            <span
                                                                class="badge bg-success bg-opacity-25 text-light fs-6 px-3 py-2">
                                                                <i class="fa fa-check me-1"></i>Approved
                                                            </span>
                                                        @else
                                                            <span
                                                                class="badge bg-danger bg-opacity-25 text-light fs-6 px-3 py-2">
                                                                <i class="fa fa-times me-1"></i>Rejected
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="text-muted">
                                                            <small>{{ $purchase->created_at->format('d M Y') }}</small>
                                                            <br>
                                                            <small>{{ $purchase->created_at->format('h:i A') }}</small>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('plan-purchases.show', $purchase->id) }}"
                                                            class="btn btn-primary btn-sm px-3 rounded-pill">
                                                            <i class="fa fa-eye me-1"></i>Review
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center py-5">
                                                        <div class="py-5">
                                                            <i class="fa fa-inbox fa-4x text-muted mb-3"></i>
                                                            <h5 class="text-muted">No Purchase Requests</h5>
                                                            <p class="text-muted">When users purchase plans, they will
                                                                appear here for review.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Select All Checkbox
            $('#selectAll').on('click', function() {
                $('.purchase-checkbox').prop('checked', this.checked);
                toggleBulkButton();
            });

            $('.purchase-checkbox').on('change', function() {
                $('#selectAll').prop('checked', $('.purchase-checkbox:checked').length === $(
                    '.purchase-checkbox').length);
                toggleBulkButton();
            });

            function toggleBulkButton() {
                const checkedCount = $('.purchase-checkbox:checked').length;
                $('#bulkApply').prop('disabled', checkedCount === 0);
                $('#selectedCount').text(checkedCount + ' selected');

                if (checkedCount > 0) {
                    $('#selectedCount').removeClass('bg-primary').addClass('bg-success');
                } else {
                    $('#selectedCount').removeClass('bg-success').addClass('bg-primary');
                }
            }

            // Bulk Action Confirmation
            $('#bulkForm').on('submit', function(e) {
                e.preventDefault();
                const action = $('select[name="action"]').val();
                const count = $('.purchase-checkbox:checked').length;

                if (!action || count === 0) return;

                const actionText = action === 'approve' ? 'approve' : 'reject';
                const actionColor = action === 'approve' ? '#28a745' : '#dc3545';
                const icon = action === 'approve' ? 'success' : 'error';

                Swal.fire({
                    title: `Confirm ${actionText.toUpperCase()}`,
                    html: `
                <div class="text-center">
                    <i class="fas fa-${action === 'approve' ? 'check-circle' : 'exclamation-triangle'} fa-4x text-${action === 'approve' ? 'success' : 'warning'} mb-3"></i>
                    <h4>${action === 'approve' ? 'Approve' : 'Reject'} ${count} Purchase${count > 1 ? 's' : ''}?</h4>
                    <p class="text-muted">This action will ${action === 'approve' ? 'activate the funding accounts' : 'decline the purchase requests'}.</p>
                </div>
            `,
                    icon: icon,
                    showCancelButton: true,
                    confirmButtonColor: actionColor,
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: `Yes, ${actionText} ${count} item${count > 1 ? 's' : ''}`,
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: 'btn-lg',
                        cancelButton: 'btn-lg'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });

            // Add hover effects
            $('.purchase-checkbox').hover(function() {
                $(this).closest('tr').toggleClass('bg-light');
            });
        });
    </script>

    <style>
        .card {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .card-header.bg-gradient-primary {
            background: linear-gradient(135deg, #6c5ce7 0%, #5649c2 100%) !important;
        }

        .table-dark {
            background: linear-gradient(135deg, #4e54c8 0%, #8f94fb 100%);
        }

        .border-start-primary {
            border-left: 0.25rem solid #4e73df !important;
        }

        .border-start-warning {
            border-left: 0.25rem solid #f6c23e !important;
        }

        .border-start-success {
            border-left: 0.25rem solid #1cc88a !important;
        }

        .border-start-danger {
            border-left: 0.25rem solid #e74a3b !important;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(108, 92, 231, 0.05);
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }

        .badge {
            font-weight: 500;
        }

        .form-check-input:checked {
            background-color: #6c5ce7;
            border-color: #6c5ce7;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6c5ce7 0%, #5649c2 100%);
            border: none;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
            border: none;
            color: #000;
        }
    </style>
@endsection
