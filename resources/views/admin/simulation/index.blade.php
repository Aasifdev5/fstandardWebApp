@extends('layout.master')

@section('title', 'Control Profit/Loss')

@section('main_content')
<div class="container-fluid px-4 py-4">

    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary bg-opacity-10 p-3 rounded-3">
                <i data-feather="target" class="text-primary" style="width: 28px; height: 28px;"></i>
            </div>
            <div>
                <h1 class="h3 mb-1 fw-bold ">
                    Control Profit/Loss
                </h1>
                <p class="text-muted mb-0">
                    Force TARGET HIT or SL HIT outcomes globally or for specific users
                </p>
            </div>
        </div>

        @php
            $globalForced = optional($global)->force_outcome;
        @endphp

        @if($globalForced && $globalForced !== 'NONE')
            <div class="alert alert-warning border-warning bg-warning bg-opacity-10 border-1 py-2 px-3 d-flex align-items-center gap-2 mb-0">
                <i class="fas fa-globe-americas text-warning"></i>
                <div>
                    <strong class="d-block">GLOBAL SIMULATION ACTIVE</strong>
                    <span class="{{ $globalForced === 'TARGET_HIT' ? 'text-success' : 'text-danger' }} fw-bold">
                        {{ str_replace('_', ' ', $globalForced) }}
                    </span>
                </div>
            </div>
        @endif
    </div>

    <!-- Global Control Card -->
    <div class="card shadow-lg border-0 mb-4 overflow-hidden">
        <div class="card-header bg-primary bg-opacity-10 border-bottom border-primary border-opacity-25 py-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-primary p-2 rounded-2">
                        <i class="fas fa-globe text-white fs-6"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold ">Global Control (All Users)</h6>
                        <small class="text-muted">Applies unless overridden per user</small>
                    </div>
                </div>
                <span class="badge bg-primary bg-opacity-25 text-primary py-2">Global</span>
            </div>
        </div>

        <div class="card-body p-4">
            <form method="POST" action="{{ route('profit-loss-control.global.update') }}" id="globalControlForm">
                @csrf
                @method('PATCH')

                <div class="row g-4 align-items-end">
                    <div class="col-md-7 col-lg-6">
                        <label class="form-label fw-semibold  mb-2">
                            <i class="fas fa-sliders-h me-2 text-primary"></i>
                            Force Outcome for All Trades
                        </label>
                        <div class="input-group input-group-lg shadow-sm">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-bullseye text-primary"></i>
                            </span>
                            <select name="force_outcome" class="form-select border-start-0 ps-0" id="globalOutcomeSelect">
                                <option value="NONE" {{ $globalForced === 'NONE' ? 'selected' : '' }}>
                                    🟢 Normal / Real Market Behavior
                                </option>
                                <option value="TARGET_HIT" {{ $globalForced === 'TARGET_HIT' ? 'selected' : '' }}>
                                    🎯 Always → TARGET HIT (Profit)
                                </option>
                                <option value="SL_HIT" {{ $globalForced === 'SL_HIT' ? 'selected' : '' }}>
                                    ⚠️ Always → SL HIT (Loss)
                                </option>
                            </select>
                        </div>
                        <div class="form-text mt-2">
                            <i class="fas fa-info-circle me-1 text-primary"></i>
                            This setting will affect all trades for all users
                        </div>
                    </div>

                    <div class="col-md-5 col-lg-4">
                        <button type="submit" class="btn btn-success btn-lg w-100 shadow-sm py-3" id="globalSubmitBtn">
                            <i class="fas fa-save me-2"></i> Apply Global Setting
                        </button>
                    </div>

                    <div class="col-lg-2">
                        <div class="d-grid">
                            <button type="button" class="btn btn-outline-secondary btn-lg" onclick="resetGlobalForm()">
                                <i class="fas fa-undo me-2"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- User Overrides Section -->
    <div class="card shadow-lg border-0 overflow-hidden">
        <div class="card-header bg-info bg-opacity-10 border-bottom border-info border-opacity-25 py-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-info p-2 rounded-2">
                        <i class="fas fa-users text-white fs-6"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold ">User-Specific Overrides</h6>
                        <small class="text-muted">Override global setting for individual traders</small>
                    </div>
                </div>
                <span class="badge bg-info bg-opacity-25 text-info py-2">
                    {{ $overrides->count() }} Active
                </span>
            </div>
        </div>

        <div class="card-body p-4">
            <!-- Add new override form -->
            <div class="card border-dashed mb-5">
                <div class="card-body p-4">
                    <h6 class="fw-bold  mb-3">
                        <i class="fas fa-plus-circle me-2 text-primary"></i>
                        Add New Override
                    </h6>
                    <form method="POST" action="{{ route('profit-loss-control.override.store') }}" id="overrideForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label fw-semibold  mb-2">
                                    <i class="fas fa-user me-2 text-primary"></i>
                                    Select Trader
                                </label>
                                <select name="user_id" class="form-select select2-custom" required style="width: 100%;">
                                    <option value="">— Choose user —</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" data-email="{{ $user->email ?? '' }}" data-mobile="{{ $user->mobile ?? '' }}">
                                            {{ $user->name }}
                                            @if($user->whatsapp_number)
                                                • {{ $user->whatsapp_number }}
                                            @elseif($user->email)
                                                • {{ $user->email }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold  mb-2">
                                    <i class="fas fa-bolt me-2 text-primary"></i>
                                    Force Outcome
                                </label>
                                <select name="force_outcome" class="form-select" required id="overrideOutcome">
                                    <option value="TARGET_HIT">🎯 Force TARGET HIT (Profit)</option>
                                    <option value="SL_HIT">⚠️ Force SL HIT (Loss)</option>
                                    <option value="NONE">🔄 Clear / Remove override</option>
                                </select>
                            </div>

                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100 shadow-sm py-3" id="overrideSubmitBtn">
                                    <i class="fas fa-user-check me-2"></i> Apply Override
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Overrides Table -->
            @if($overrides->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle" id="basic-1">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Trader</th>
                                <th>Outcome</th>
                                <th>Applied</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($overrides as $override)
                                <tr class="border-bottom border-light">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-3 bg-gradient-primary text-white shadow-sm">
                                                {{ strtoupper(substr($override->user->name ?? 'U', 0, 2)) }}
                                            </div>
                                            <div>
                                                <strong class="d-block ">{{ $override->user->name }}</strong>
                                                <small class="text-muted">
                                                    @if($override->user->mobile)
                                                        <i class="fas fa-phone me-1"></i>{{ $override->user->mobile }}
                                                    @elseif($override->user->email)
                                                        <i class="fas fa-envelope me-1"></i>{{ $override->user->email }}
                                                    @else
                                                        <i class="fas fa-user me-1"></i>No contact
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($override->force_outcome === 'TARGET_HIT')
                                            <span class="badge bg-success bg-opacity-10  border border-success border-opacity-25 px-3 py-2 d-inline-flex align-items-center gap-2">
                                                <i class="fas fa-trophy"></i>
                                                <span class="fw-bold">TARGET HIT</span>
                                            </span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10  border border-danger border-opacity-25 px-3 py-2 d-inline-flex align-items-center gap-2">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                <span class="fw-bold">SL HIT</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-clock text-primary"></i>
                                            <span>{{ $override->created_at->diffForHumans() }}</span>
                                        </div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <form action="{{ route('profit-loss-control.override.destroy', $override->id) }}"
                                              method="POST" class="d-inline-block delete-override-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-danger delete-override-btn shadow-sm"
                                                    data-user-name="{{ $override->user->name }}"
                                                    data-outcome="{{ $override->force_outcome }}">
                                                <i class="fas fa-trash-alt me-1"></i> Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5 my-4">
                    <div class="bg-light rounded-circle p-4 d-inline-block mb-3">
                        <i class="fas fa-user-shield fa-4x text-muted opacity-25"></i>
                    </div>
                    <h5 class=" mb-2 fw-bold">No user overrides yet</h5>
                    <p class="text-muted mb-4">Use the form above to force outcomes for specific traders</p>
                    <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('overrideForm').scrollIntoView({behavior: 'smooth'})">
                        <i class="fas fa-plus me-2"></i> Create First Override
                    </button>
                </div>
            @endif
        </div>
    </div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Initialize Select2
    $(document).ready(function() {
        $('.select2-custom').select2({
            placeholder: "— Choose user —",
            allowClear: true,
            width: '100%'
        });

        // Set default selection based on current global setting
        const globalOutcome = "{{ $globalForced }}";
        if(globalOutcome) {
            $('#globalOutcomeSelect').val(globalOutcome);
        }
    });

    // Global form submission with SweetAlert
    $('#globalControlForm').on('submit', function(e) {
        e.preventDefault();

        const selectedValue = $('#globalOutcomeSelect').val();
        let title, text, icon, confirmButtonColor;

        switch(selectedValue) {
            case 'TARGET_HIT':
                title = 'Apply Global TARGET HIT?';
                text = 'All trades for all users will be forced to hit TARGET (Profit)';
                icon = 'warning';
                confirmButtonColor = '#198754';
                break;
            case 'SL_HIT':
                title = 'Apply Global SL HIT?';
                text = 'All trades for all users will be forced to hit SL (Loss)';
                icon = 'warning';
                confirmButtonColor = '#dc3545';
                break;
            default:
                title = 'Reset to Normal Behavior?';
                text = 'All trades will follow real market behavior';
                icon = 'info';
                confirmButtonColor = '#0d6efd';
        }

        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: confirmButtonColor,
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, apply setting',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
            customClass: {
                confirmButton: 'btn-lg',
                cancelButton: 'btn-lg'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading state
                const submitBtn = $('#globalSubmitBtn');
                const originalText = submitBtn.html();
                submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i> Applying...');
                submitBtn.prop('disabled', true);

                // Submit form
                setTimeout(() => {
                    $('#globalControlForm')[0].submit();
                }, 500);
            }
        });
    });

    // Override form submission with SweetAlert
    $('#overrideForm').on('submit', function(e) {
        e.preventDefault();

        const userId = $('[name="user_id"]').val();
        const outcome = $('#overrideOutcome').val();
        const userName = $('[name="user_id"] option:selected').text().split('•')[0].trim();

        if(!userId) {
            Swal.fire({
                icon: 'error',
                title: 'Missing Information',
                text: 'Please select a user first',
                confirmButtonColor: '#0d6efd'
            });
            return;
        }

        let title, text, icon, confirmButtonColor;

        switch(outcome) {
            case 'TARGET_HIT':
                title = 'Force TARGET HIT for ' + userName + '?';
                text = 'All trades for this user will be forced to hit TARGET (Profit)';
                icon = 'success';
                confirmButtonColor = '#198754';
                break;
            case 'SL_HIT':
                title = 'Force SL HIT for ' + userName + '?';
                text = 'All trades for this user will be forced to hit SL (Loss)';
                icon = 'error';
                confirmButtonColor = '#dc3545';
                break;
            default:
                title = 'Remove Override for ' + userName + '?';
                text = 'This user will follow global or normal market behavior';
                icon = 'info';
                confirmButtonColor = '#0d6efd';
        }

        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: confirmButtonColor,
            cancelButtonColor: '#6c757d',
            confirmButtonText: outcome === 'NONE' ? 'Yes, remove override' : 'Yes, apply override',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading state
                const submitBtn = $('#overrideSubmitBtn');
                const originalText = submitBtn.html();
                submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i> Applying...');
                submitBtn.prop('disabled', true);

                // Submit form
                setTimeout(() => {
                    $('#overrideForm')[0].submit();
                }, 500);
            }
        });
    });

    // Delete override with SweetAlert
    $(document).on('click', '.delete-override-btn', function() {
        const button = $(this);
        const userName = button.data('user-name');
        const outcome = button.data('outcome');
        const form = button.closest('form');

        Swal.fire({
            title: 'Remove Override?',
            html: `<div class="text-start">
                <p>Are you sure you want to remove the override for <strong>${userName}</strong>?</p>
                <div class="alert alert-warning border-warning bg-warning bg-opacity-10 mt-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    This user will return to following ${globalForced === 'NONE' ? 'normal market behavior' : 'global settings'}
                </div>
            </div>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, remove it',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading state on button
                button.html('<i class="fas fa-spinner fa-spin me-1"></i> Removing...');
                button.prop('disabled', true);

                // Submit the form
                form.submit();
            }
        });
    });

    // Reset global form
    function resetGlobalForm() {
        $('#globalOutcomeSelect').val('NONE');
        Swal.fire({
            icon: 'info',
            title: 'Form Reset',
            text: 'Global control form has been reset to default values',
            timer: 1500,
            showConfirmButton: false
        });
    }

    // Auto-refresh page after form submissions if needed
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#0d6efd'
        });
    @endif
</script>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 12px;
    }

    .border-dashed {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
    }

    .avatar-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 18px;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #198754 0%, #157347 100%);
    }

    .bg-gradient-danger {
        background: linear-gradient(135deg, #dc3545 0%, #bb2d3b 100%);
    }

    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        color: #6c757d;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.04);
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .select2-custom {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 0.5rem;
    }

    .select2-custom:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    #globalOutcomeSelect option[value="TARGET_HIT"] {
        background-color: rgba(25, 135, 84, 0.1);
    }

    #globalOutcomeSelect option[value="SL_HIT"] {
        background-color: rgba(220, 53, 69, 0.1);
    }

    #globalOutcomeSelect option[value="NONE"] {
        background-color: rgba(108, 117, 125, 0.1);
    }
</style>
@endsection

@section('scripts')

@endsection
