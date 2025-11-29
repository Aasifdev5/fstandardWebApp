@extends('layout.master')
@section('title', 'Icons Around the World - Admin')

@section('main_content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-1">
                                <i class="fas fa-star text-warning me-2"></i>
                                Icons Around the World
                            </h2>
                            <p class="text-muted">Manage celebrity video endorsements</p>
                        </div>
                        <button class="btn btn-primary btn-lg shadow-sm" data-bs-toggle="modal"
                            data-bs-target="#addEditModal">
                            <i class="fas fa-plus me-2"></i>Add New Star
                        </button>
                    </div>
                </div>
            </div>

            <!-- Flash Messages -->
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm">
                    <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Cards Grid -->
            <div class="row g-4" id="endorsements-container">
                @forelse($endorsements as $star)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-lg h-100 {{ $star->is_active ? '' : 'opacity-50' }}">
                            <div class="position-relative">
                                <img src="{{ $star->image
                                    ? asset($star->image)
                                    : 'https://via.placeholder.com/400x300/1a1a2e/ffffff?text=' . urlencode($star->name) }}"
                                    class="card-img-top" style="height: 220px; object-fit: cover;">

                                <div class="position-absolute top-0 end-0 p-3">
                                    <span class="badge {{ $star->is_active ? 'bg-success' : 'bg-secondary' }} fs-6">
                                        {{ $star->is_active ? 'Live' : 'Hidden' }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">{{ $star->name }}</h5>
                                <p class="text-muted fst-italic">{{ $star->role }}</p>
                                <p class="text-dark">“{{ Str::limit($star->quote, 80) }}”</p>

                                <div class="mt-4 d-flex gap-2 justify-content-center flex-wrap">
                                    <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $star->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $star->id }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                    <button
                                        class="btn btn-sm {{ $star->is_active ? 'btn-success' : 'btn-secondary' }} toggle-btn"
                                        data-id="{{ $star->id }}">
                                        <i class="fas fa-eye{{ $star->is_active ? '' : '-slash' }}"></i>
                                        {{ $star->is_active ? 'On' : 'Off' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-video-slash fa-5x text-muted mb-4"></i>
                        <h4>No celebrity videos yet</h4>
                        <p class="text-muted">Click "Add New Star" to begin</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div class="modal fade" id="addEditModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form id="endorsementForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="endorsement_id">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-gradient-primary text-white">
                        <h5 class="modal-title" id="modalTitle">Add New Celebrity</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Role</label>
                                <input type="text" name="role" class="form-control" placeholder="e.g., Footballer"
                                    required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Quote</label>
                                <textarea name="quote" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">YouTube Video ID</label>
                                <input type="text" name="youtube_id" class="form-control" placeholder="e.g., ScMzIvxBSi4"
                                    required>
                                <small class="text-muted">Only the ID from URL:
                                    https://youtu.be/<strong>ScMzIvxBSi4</strong></small>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Image (Recommended: 400x300)</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <div class="mt-2 text-center">
                                    <img id="imagePreview" src="" class="img-fluid rounded shadow"
                                        style="max-height: 200px; display: none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-save me-2"></i><span id="submitText">Save Celebrity</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            const form = $('#endorsementForm');
            const modal = $('#addEditModal');

            // Image Preview
            $('input[name="image"]').change(function(e) {
                const file = e.target.files[0];
                if (file) {
                    $('#imagePreview').attr('src', URL.createObjectURL(file)).show();
                }
            });

            // Open Add Modal
            $('button[data-bs-target="#addEditModal"]').click(function() {
                form[0].reset();
                $('#endorsement_id').val('');
                $('#modalTitle').text('Add New Celebrity');
                $('#submitText').text('Save Celebrity');
                $('#imagePreview').hide();
            });

            // Edit Button
            $('.edit-btn').on('click', function() {
                const id = $(this).data('id');
                $.get(`/admin/celebrity-endorsements/${id}/edit`, function(data) {
                    $('#endorsement_id').val(data.id);
                    $('[name="name"]').val(data.name);
                    $('[name="role"]').val(data.role);
                    $('[name="quote"]').val(data.quote);
                    $('[name="youtube_id"]').val(data.youtube_id);
                    $('#modalTitle').text('Edit Celebrity');
                    $('#submitText').text('Update');
                    if (data.image) {
                        $('#imagePreview').attr('src', `/storage/${data.image}`).show();
                    } else {
                        $('#imagePreview').hide();
                    }
                    modal.modal('show');
                });
            });

            // Form Submit (Add & Update)
            form.on('submit', function(e) {
                e.preventDefault();
                const id = $('#endorsement_id').val();
                const url = id ? `/admin/celebrity-endorsements/${id}` : '/admin/celebrity-endorsements';
                const type = id ? 'PUT' : 'POST';

                let formData = new FormData(this);
                formData.append('_method', id ? 'PUT' : 'POST');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        Swal.fire('Success!', res.message, 'success').then(() => location
                            .reload());
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', xhr.responseJSON?.message || 'Something went wrong',
                            'error');
                    }
                });
            });

            // Delete
            $(document).on('click', '.delete-btn', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Delete this star?',
                    text: "This cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete!'
                }).then(result => {
                    if (result.isConfirmed) {
                        $.post(`/admin/celebrity-endorsements/${id}`, {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        }, () => location.reload());
                    }
                });
            });

            // Toggle Active
            $(document).on('click', '.toggle-btn', function() {
                const id = $(this).data('id');
                $.post(`/admin/celebrity-endorsements/${id}/toggle`, {
                    _token: '{{ csrf_token() }}'
                }, function() {
                    location.reload();
                });
            });
        });
    </script>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card:hover {
            transform: translateY(-5px);
            transition: all 0.3s;
        }

        .opacity-50 {
            filter: opacity(0.6);
        }
    </style>
@endsection
