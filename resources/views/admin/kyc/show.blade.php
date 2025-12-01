@extends('layout.master')

@section('title', 'KYC Details - ' . $kyc->first_name . ' ' . $kyc->last_name)

@section('main_content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-0">
                        <i class="fas fa-id-card text-primary me-2"></i>KYC Application Details
                    </h2>
                    <p class="text-muted mb-0">Application ID: {{ $kyc->id }} | Submitted: {{ $kyc->submitted_at->format('d M Y, h:i A') }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('kyc.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>


                        <a href="{{ route('kyc.create') }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>



                        @if($kyc->status == 'submitted')
                            <button class="btn btn-success" onclick="approveKyc({{ $kyc->id }})">
                                <i class="fas fa-check me-2"></i>Approve
                            </button>
                            <button class="btn btn-danger" onclick="rejectKyc({{ $kyc->id }})">
                                <i class="fas fa-times me-2"></i>Reject
                            </button>
                        @endif

                </div>
            </div>

            <!-- Status Alert -->
            <div class="alert alert-{{ $kyc->status_color }} alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-{{ $kyc->status_icon }} fa-2x me-3"></i>
                    <div>
                        <h5 class="alert-heading mb-1">Status: {{ ucfirst($kyc->status) }}</h5>
                        @if($kyc->status == 'approved')
                            <p class="mb-0">Approved on {{ $kyc->verified_at->format('d M Y') }} by Admin</p>
                            @if($kyc->demat_account_number)
                                <p class="mb-0 mt-1">
                                    <strong>DEMAT Account:</strong> {{ $kyc->demat_account_number }} |
                                    <strong>Trading Account:</strong> {{ $kyc->trading_account_number }}
                                </p>
                            @endif
                        @elseif($kyc->status == 'rejected')
                            <p class="mb-0">Rejected on {{ $kyc->rejected_at->format('d M Y') }}</p>
                            @if($kyc->rejection_reason)
                                <p class="mb-0 mt-1"><strong>Reason:</strong> {{ $kyc->rejection_reason }}</p>
                            @endif
                        @elseif($kyc->status == 'submitted')
                            <p class="mb-0">Submitted on {{ $kyc->submitted_at->format('d M Y') }}. Under review.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- User Information Card -->
            <div class="row">
                <!-- Personal Information -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-gradient-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-user-circle me-2"></i>Personal Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Full Name:</strong></p>
                                    <p>{{ $kyc->first_name }} {{ $kyc->middle_name ? $kyc->middle_name . ' ' : '' }}{{ $kyc->last_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>PAN Number:</strong></p>
                                    <p class="text-uppercase">{{ $kyc->pan_number }}</p>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Date of Birth:</strong></p>
                                    <p>{{ \Carbon\Carbon::parse($kyc->date_of_birth)->format('d M Y') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Gender:</strong></p>
                                    <p class="text-capitalize">{{ $kyc->gender }}</p>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Father's Name:</strong></p>
                                    <p>{{ $kyc->father_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Mother's Name:</strong></p>
                                    <p>{{ $kyc->mother_name ?? 'Not provided' }}</p>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Aadhaar Number:</strong></p>
                                    <p>{{ $kyc->aadhaar_number }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Mobile Number:</strong></p>
                                    <p>{{ $kyc->mobile_number }}</p>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <p class="mb-2"><strong>Email:</strong></p>
                                    <p>{{ $kyc->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-gradient-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-home me-2"></i>Address Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6 class="text-primary mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>Permanent Address
                            </h6>
                            <p>{{ $kyc->permanent_address }}</p>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <p class="mb-1"><small class="text-muted">City:</small></p>
                                    <p>{{ $kyc->permanent_city }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-1"><small class="text-muted">State:</small></p>
                                    <p>{{ $kyc->permanent_state }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-1"><small class="text-muted">PIN Code:</small></p>
                                    <p>{{ $kyc->permanent_pincode }}</p>
                                </div>
                            </div>

                            <hr class="my-4">

                            <h6 class="text-primary mb-3">
                                <i class="fas fa-mail-bulk me-2"></i>Correspondence Address
                                @if($kyc->same_as_permanent)
                                    <span class="badge bg-success ms-2">Same as Permanent</span>
                                @endif
                            </h6>

                            @if(!$kyc->same_as_permanent)
                                <p>{{ $kyc->correspondence_address }}</p>
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <p class="mb-1"><small class="text-muted">City:</small></p>
                                        <p>{{ $kyc->correspondence_city }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mb-1"><small class="text-muted">State:</small></p>
                                        <p>{{ $kyc->correspondence_state }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mb-1"><small class="text-muted">PIN Code:</small></p>
                                        <p>{{ $kyc->correspondence_pincode }}</p>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted fst-italic">Same as permanent address</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bank & Financial Information -->
            <div class="row">
                <!-- Bank Details -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-gradient-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-university me-2"></i>Bank Details
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Bank Name:</strong></p>
                                    <p>{{ $kyc->bank_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Account Holder:</strong></p>
                                    <p>{{ $kyc->account_holder_name }}</p>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Account Number:</strong></p>
                                    <p>••••••••{{ substr($kyc->account_number, -4) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>IFSC Code:</strong></p>
                                    <p class="text-uppercase">{{ $kyc->ifsc_code }}</p>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Branch Name:</strong></p>
                                    <p>{{ $kyc->branch_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Branch Address:</strong></p>
                                    <p>{{ $kyc->bank_address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Financial Information -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-gradient-warning text-dark">
                            <h5 class="mb-0">
                                <i class="fas fa-chart-line me-2"></i>Financial Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Occupation:</strong></p>
                                    <p class="text-capitalize">{{ $kyc->occupation_type }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Annual Income:</strong></p>
                                    <p>₹ {{ number_format($kyc->annual_income) }}</p>
                                </div>
                            </div>

                            @if($kyc->company_name)
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Company Name:</strong></p>
                                    <p>{{ $kyc->company_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Designation:</strong></p>
                                    <p>{{ $kyc->designation ?? 'Not provided' }}</p>
                                </div>
                            </div>
                            @endif

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Income Source:</strong></p>
                                    <p class="text-capitalize">{{ $kyc->income_source }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Risk Appetite:</strong></p>
                                    <p>
                                        <span class="badge bg-{{ $kyc->risk_appetite == 'low' ? 'success' : ($kyc->risk_appetite == 'moderate' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($kyc->risk_appetite) }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Investment Experience:</strong></p>
                                    <p class="text-capitalize">{{ $kyc->investment_experience }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Politically Exposed:</strong></p>
                                    <p>
                                        <span class="badge bg-{{ $kyc->politically_exposed ? 'danger' : 'success' }}">
                                            {{ $kyc->politically_exposed ? 'Yes' : 'No' }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            @if($kyc->investment_objectives)
                            <div class="mt-3">
                                <p class="mb-2"><strong>Investment Objectives:</strong></p>
                                <p class="text-muted">{{ $kyc->investment_objectives }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-gradient-danger text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i>Uploaded Documents
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        @php
                            $documents = [
                                'pan' => ['icon' => 'fa-id-card', 'label' => 'PAN Card', 'path' => $kyc->pan_card_path],
                                'aadhaar_front' => ['icon' => 'fa-address-card', 'label' => 'Aadhaar Front', 'path' => $kyc->aadhaar_front_path],
                                'aadhaar_back' => ['icon' => 'fa-address-card', 'label' => 'Aadhaar Back', 'path' => $kyc->aadhaar_back_path],
                                'photo' => ['icon' => 'fa-camera', 'label' => 'Passport Photo', 'path' => $kyc->passport_photo_path],
                                'signature' => ['icon' => 'fa-signature', 'label' => 'Signature', 'path' => $kyc->signature_path],
                                'cheque' => ['icon' => 'fa-money-check', 'label' => 'Cancelled Cheque', 'path' => $kyc->cancelled_cheque_path],
                                'address' => ['icon' => 'fa-file-contract', 'label' => 'Address Proof', 'path' => $kyc->address_proof_path],
                            ];

                            if($kyc->income_proof_path) {
                                $documents['income'] = ['icon' => 'fa-file-invoice-dollar', 'label' => 'Income Proof', 'path' => $kyc->income_proof_path];
                            }
                        @endphp

                        @foreach($documents as $type => $doc)
                            @if($doc['path'])
                                <div class="col-md-4 col-lg-3">
                                    <div class="card document-card border h-100">
                                        <div class="card-body text-center">
                                            <i class="fas {{ $doc['icon'] }} fa-3x text-primary mb-3"></i>
                                            <h6 class="card-title mb-3">{{ $doc['label'] }}</h6>

                                            @php
                                                $extension = pathinfo($doc['path'], PATHINFO_EXTENSION);
                                                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                                            @endphp

                                            @if($isImage)
                                                <div class="mb-3">
                                                    <img src="{{ asset($doc['path']) }}"
                                                         alt="{{ $doc['label'] }}"
                                                         class="img-fluid rounded border"
                                                         style="max-height: 150px; object-fit: contain;">
                                                </div>
                                            @endif

                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('kyc.download', ['kyc' => $kyc->id, 'type' => $type]) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-download me-1"></i>Download
                                                </a>

                                                @if($isImage)
                                                    <button type="button"
                                                            class="btn btn-sm btn-info"
                                                            onclick="showDocument('{{ asset($doc['path']) }}', '{{ $doc['label'] }}')">
                                                        <i class="fas fa-eye me-1"></i>View
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- System Information -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-gradient-secondary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>System Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <p class="mb-2"><strong>Submission IP:</strong></p>
                            <p><code>{{ $kyc->submission_ip }}</code></p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-2"><strong>Submitted At:</strong></p>
                            <p>{{ $kyc->submitted_at->format('d M Y, h:i A') }}</p>
                        </div>
                        @if($kyc->verified_at)
                        <div class="col-md-3">
                            <p class="mb-2"><strong>Verified At:</strong></p>
                            <p>{{ $kyc->verified_at->format('d M Y, h:i A') }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-2"><strong>Verified By:</strong></p>
                            <p>Admin #{{ $kyc->verified_by }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Document View -->
<div class="modal fade" id="documentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentModalLabel">Document View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="documentImage" src="" alt="Document" class="img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" id="downloadDocument" class="btn btn-primary">
                    <i class="fas fa-download me-2"></i>Download
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Document viewer modal
    function showDocument(imageSrc, title) {
        document.getElementById('documentImage').src = imageSrc;
        document.getElementById('documentModalLabel').textContent = title;
        document.getElementById('downloadDocument').href = imageSrc;
        document.getElementById('downloadDocument').download = title.replace(/\s+/g, '_').toLowerCase() + '.jpg';

        const modal = new bootstrap.Modal(document.getElementById('documentModal'));
        modal.show();
    }

    // Admin approval functions
    function approveKyc(kycId) {
        Swal.fire({
            title: 'Approve KYC?',
            text: 'This will approve the KYC application and generate trading accounts.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Approve',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#198754',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/kyc/${kycId}/approve`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Approved!',
                            text: 'KYC has been approved successfully.',
                            confirmButtonColor: '#198754'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Failed to approve KYC',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                        confirmButtonColor: '#dc3545'
                    });
                });
            }
        });
    }

    function rejectKyc(kycId) {
        Swal.fire({
            title: 'Reject KYC?',
            html: `
                <textarea id="rejectionReason" class="form-control mt-3"
                          placeholder="Please provide reason for rejection..."
                          rows="3"></textarea>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Reject',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#dc3545',
            preConfirm: () => {
                const reason = document.getElementById('rejectionReason').value;
                if (!reason.trim()) {
                    Swal.showValidationMessage('Please provide a reason for rejection');
                    return false;
                }
                return reason;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/kyc/${kycId}/reject`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ reason: result.value })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Rejected!',
                            text: 'KYC has been rejected.',
                            confirmButtonColor: '#198754'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Failed to reject KYC',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                        confirmButtonColor: '#dc3545'
                    });
                });
            }
        });
    }
</script>


@endsection
