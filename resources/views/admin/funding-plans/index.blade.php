@extends('layout.master')

@section('title', 'Funding Plans Management')

@section('main_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- Success/Fail Messages -->
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(Session::has('fail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('fail') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>Funding Plans List</h2>
                        <a href="{{ route('funding-plans.create') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> Add New Plan
                        </a>
                    </div>
                    <div class="card-body">
                        <button id="bulk-delete" class="btn btn-danger mb-3" disabled>
                            <i class="fas fa-trash-alt"></i> Delete Selected
                        </button>

                        <div class="table-responsive">
                            <table id="basic-1" class="table table-bordered table-style data-table-filter">
                                <thead class="table-dark">
                                    <tr>
                                        <th><input type="checkbox" id="select-all"></th>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Capital</th>
                                        <th>Fee</th>
                                        <th>Profit Target</th>
                                        <th>Max Loss</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($plans as $plan)
                                        <tr class="removable-item">
                                            <td>
                                                <input type="checkbox" class="plan-checkbox" value="{{ $plan->id }}">
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><strong>{{ $plan->title }}</strong></td>
                                            <td>₹{{ number_format($plan->capital) }}</td>
                                            <td>₹{{ number_format($plan->fee) }}</td>
                                            <td>{{ $plan->profit_target }}</td>
                                            <td>{{ $plan->max_loss }}</td>
                                            <td>
                                                <span class="badge {{ $plan->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $plan->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action__buttons">
                                                    <a href="{{ route('funding-plans.edit', $plan->id) }}"
                                                       class="btn btn-icon btn-success btn-sm" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                       class="btn btn-icon btn-danger btn-sm delete-plan"
                                                       data-url="{{ route('funding-plans.destroy', $plan->id) }}"
                                                       title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted py-4">
                                                No funding plans found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
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
    // Select All
    $('#select-all').on('click', function() {
        $('.plan-checkbox').prop('checked', this.checked);
        toggleBulkDelete();
    });

    $('.plan-checkbox').on('change', function() {
        $('#select-all').prop('checked', $('.plan-checkbox:checked').length === $('.plan-checkbox').length);
        toggleBulkDelete();
    });

    function toggleBulkDelete() {
        $('#bulk-delete').prop('disabled', $('.plan-checkbox:checked').length === 0);
    }

    // Bulk Delete
    $('#bulk-delete').on('click', function() {
        let selected = $('.plan-checkbox:checked').map(function() {
            return this.value;
        }).get();

        if (selected.length === 0) return;

        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to delete " + selected.length + " plan(s). This cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Yes, delete!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('funding-plans.bulk-delete') }}",
                    type: "POST",
                    data: {
                        ids: selected,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function() {
                        location.reload();
                    }
                });
            }
        });
    });

    // Single Delete
    $('.delete-plan').on('click', function() {
        let url = $(this).data('url');

        Swal.fire({
            title: 'Delete Plan?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: { _token: "{{ csrf_token() }}" },
                    success: function() {
                        location.reload();
                    }
                });
            }
        });
    });
});
</script>
@endsection
