@extends('layout.master')
@section('title', 'Admin - Orders Management')

@section('main_content')
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Order Management</h2>
                <p class="text-muted mb-0">Monitor and manage all trading orders across the platform</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary" id="exportBtn">
                    <i class="fas fa-download me-2"></i>Export
                </button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fas fa-filter me-2"></i>Filters
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Orders</div>
                                <div class="h5 mb-0 fw-bold">{{ $orders->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-success text-uppercase mb-1">Close</div>
                                <div class="h5 mb-0 fw-bold">{{ $orders->where('status', '1')->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-warning text-uppercase mb-1">Open</div>
                                <div class="h5 mb-0 fw-bold">{{ $orders->where('status', '0')->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-danger text-uppercase mb-1">Cancelled</div>
                                <div class="h5 mb-0 fw-bold">{{ $orders->where('status', 'cancelled')->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Table Card -->
        <div class="card shadow-lg border-0">
            <div class="card-header  py-3 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">All Orders</h5>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-1" class="table table-hover mb-0" id="ordersTable">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                <th>Order ID</th>
                                <th>User</th>
                                <th>Challenge</th>
                                <th>Symbol</th>
                                <th>Side</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Filled</th>
                                <th>Status</th>
                                <th>Date</th>
                                {{-- <th class="text-end pe-4">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="order-row" data-status="{{ $order->status }}">
                                    <td class="ps-4">
                                        <div class="form-check">
                                            <input class="form-check-input order-checkbox" type="checkbox"
                                                value="{{ $order->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold text-primary">#{{ sprintf('%06d', $order->id) }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="avatar avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2">
                                                <span
                                                    class="text-primary fw-bold">{{ substr($order->user->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="fw-medium">{{ $order->user->name }}</div>
                                                <small class="text-muted">{{ $order->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-3 py-1">
                                            {{ $order->challenge?->plan?->title ?? '—' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol-icon bg-light rounded-circle p-2 me-2">
                                                <i class="fas fa-chart-line text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $order->stock_symbol }}</div>
                                                <small class="text-muted">Stock</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {!! $order->side_badge !!}
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25">
                                            {{ $order->type_text }}
                                        </span>
                                    </td>
                                    <td class="fw-semibold">{{ $order->quantity }}</td>
                                    <td class="fw-bold text-dark">₹{{ number_format($order->price, 2) }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                                @php
                                                    $fillPercentage =
                                                        $order->quantity > 0
                                                            ? ($order->filled_quantity / $order->quantity) * 100
                                                            : 0;
                                                @endphp
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $fillPercentage }}%"
                                                    aria-valuenow="{{ $fillPercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <span
                                                class="text-muted small">{{ $order->filled_quantity }}/{{ $order->quantity }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        {!! $order->status_badge !!}
                                    </td>
                                    <td>
                                        <div class="text-muted small">{{ $order->created_at->format('d M') }}</div>
                                        <div class="small">{{ $order->created_at->format('H:i') }}</div>
                                    </td>
                                    {{-- <td class="text-end pe-4">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light rounded-circle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#orderDetailsModal{{ $order->id }}">
                                            <i class="fas fa-eye me-2"></i>View Details
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-edit me-2"></i>Edit Order
                                        </a>
                                    </li>
                                    @if ($order->status == 'pending')
                                    <li>
                                        <a class="dropdown-item text-danger" href="#">
                                            <i class="fas fa-times me-2"></i>Cancel Order
                                        </a>
                                    </li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-user me-2"></i>View User Profile
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



        </div>

        <!-- Bulk Actions Bar -->
        <div class="bulk-actions-bar fixed-bottom  border-top shadow-lg p-3" style="display: none;">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="fw-medium" id="selectedCount">0</span> orders selected
                    </div>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" style="width: auto;">
                            <option>Bulk Actions</option>
                            <option value="cancel">Cancel Orders</option>
                            <option value="export">Export Selected</option>
                            <option value="archive">Archive Orders</option>
                        </select>
                        <button class="btn btn-sm btn-primary">Apply</button>
                        <button class="btn btn-sm btn-outline-secondary" id="clearSelection">Clear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="filterModalLabel">Filter Orders</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <div class="d-flex flex-wrap gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="statusAll" checked>
                                    <label class="form-check-label" for="statusAll">All</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="statusPending" checked>
                                    <label class="form-check-label" for="statusPending">Pending</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="statusFilled" checked>
                                    <label class="form-check-label" for="statusFilled">Filled</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="statusCancelled" checked>
                                    <label class="form-check-label" for="statusCancelled">Cancelled</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Side</label>
                            <div class="d-flex flex-wrap gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="sideAll" checked>
                                    <label class="form-check-label" for="sideAll">All</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="sideBuy" checked>
                                    <label class="form-check-label" for="sideBuy">Buy</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="sideSell" checked>
                                    <label class="form-check-label" for="sideSell">Sell</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date Range</label>
                            <div class="input-group input-group-sm">
                                <input type="date" class="form-control" id="dateFrom">
                                <span class="input-group-text">to</span>
                                <input type="date" class="form-control" id="dateTo">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Challenge</label>
                            <select class="form-select form-select-sm">
                                <option value="">All Challenges</option>
                                <option value="1">Beginner Challenge</option>
                                <option value="2">Pro Challenge</option>
                                <option value="3">Expert Challenge</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Apply Filters</button>
                    <button type="button" class="btn btn-link text-decoration-none">Reset Filters</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sample Order Details Modal (would be dynamic in real app) -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="orderDetailsModalLabel">Order Details #001234</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Order details would go here -->
                </div>
            </div>
        </div>
    </div>

    <style>
        .avatar {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .symbol-icon {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .order-row:hover {
            background-color: rgba(0, 123, 255, 0.02);
        }

        .progress {
            min-width: 80px;
        }

        .bulk-actions-bar {
            transition: all 0.3s ease;
            bottom: -100px;
        }

        .bulk-actions-bar.show {
            bottom: 0;
        }

        .card {
            border-radius: 12px;
            overflow: hidden;
        }

        .table th {
            font-weight: 600;
            color: #495057;
            border-top: none;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            vertical-align: middle;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .badge {
            padding: 0.35em 0.65em;
            font-weight: 500;
        }

        .border-left-primary {
            border-left: 4px solid #4e73df !important;
        }

        .border-left-success {
            border-left: 4px solid #1cc88a !important;
        }

        .border-left-warning {
            border-left: 4px solid #f6c23e !important;
        }

        .border-left-danger {
            border-left: 4px solid #e74a3b !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bulk selection functionality
            const selectAllCheckbox = document.getElementById('selectAll');
            const orderCheckboxes = document.querySelectorAll('.order-checkbox');
            const bulkActionsBar = document.querySelector('.bulk-actions-bar');
            const selectedCount = document.getElementById('selectedCount');
            const clearSelectionBtn = document.getElementById('clearSelection');

            selectAllCheckbox.addEventListener('change', function() {
                orderCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
                updateBulkActionsBar();
            });

            orderCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateBulkActionsBar);
            });

            function updateBulkActionsBar() {
                const selected = document.querySelectorAll('.order-checkbox:checked').length;
                selectedCount.textContent = selected;

                if (selected > 0) {
                    bulkActionsBar.style.display = 'block';
                    setTimeout(() => {
                        bulkActionsBar.classList.add('show');
                    }, 10);
                } else {
                    bulkActionsBar.classList.remove('show');
                    setTimeout(() => {
                        if (selected === 0) {
                            bulkActionsBar.style.display = 'none';
                        }
                    }, 300);
                }
            }

            clearSelectionBtn.addEventListener('click', function() {
                orderCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
                selectAllCheckbox.checked = false;
                updateBulkActionsBar();
            });

            // Search functionality
            const orderSearch = document.getElementById('orderSearch');
            const orderRows = document.querySelectorAll('.order-row');

            orderSearch.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();

                orderRows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    row.style.display = rowText.includes(searchTerm) ? '' : 'none';
                });
            });

            // Export button
            document.getElementById('exportBtn').addEventListener('click', function() {
                // In a real app, this would trigger a file download
                alert('Export functionality would be implemented here');
            });
        });
    </script>

@endsection
