@extends('layout.master')

@section('title')
    {{ __('Manual Pattern Definition Control') }}
@endsection

@section('main_content')
    <div class="page-content">
        <div class="container-fluid">

            {{-- Flash Messages --}}
            @if (Session::has('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '{{ session('success') }}',
                        timer: 3000,
                        showConfirmButton: false
                    });
                </script>
            @endif

            @if (Session::has('fail'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '{{ session('fail') }}',
                        timer: 3000,
                        showConfirmButton: false
                    });
                </script>
            @endif

            {{-- Page Header --}}
            <div class="row mb-3">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">{{ __('Manual Pattern Definition Control') }}</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Pattern Definitions') }}</li>
                        </ol>
                    </div>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="row">
                <div class="col-xl-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-wave-square me-2"></i>{{ __('Pattern Definitions') }}</h5>
                            <a href="{{ route('pattern-definitions.create') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-plus-circle me-1"></i> {{ __('Add New') }}
                            </a>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="basic-1" class="table table-bordered table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Pattern ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Direction</th>
                                        <th>Volatility Bias</th>
                                        <th>Behavioral Bias</th>
                                        <th>Definition JSON</th>
                                        <th>Active</th>
                                        <th>Priority</th>
                                        <th>Confidence</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($patterns as $pattern)
                                        <tr>
                                            <td>{{ $pattern->id }}</td>
                                            <td>{{ $pattern->pattern_id }}</td>
                                            <td>{{ $pattern->name }}</td>
                                            <td>{{ $pattern->category }}</td>
                                            <td>{{ $pattern->direction }}</td>
                                            <td>{{ $pattern->volatility_bias }}</td>
                                            <td>{{ $pattern->behavioral_bias }}</td>
                                            <td style="max-width: 300px;">
                                                <div
                                                    style="max-height: 150px; overflow: auto; background: #f8f9fa; padding: 6px; border-radius: 4px; font-size: 12px;">
                                                    <pre>{{ json_encode($pattern->definition_json, JSON_PRETTY_PRINT) }}</pre>
                                                </div>
                                            </td>

                                            <td>
                                                @if ($pattern->is_active)
                                                    <span class="badge bg-success">Yes</span>
                                                @else
                                                    <span class="badge bg-danger">No</span>
                                                @endif
                                            </td>
                                            <td>{{ $pattern->priority }}</td>
                                            <td>{{ $pattern->confidence_weight }}</td>
                                            <td>{{ $pattern->created_at }}</td>
                                            <td>{{ $pattern->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('pattern-definitions.edit', $pattern->id) }}"
                                                    class="btn btn-sm btn-warning mb-1"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('pattern-definitions.destroy', $pattern->id) }}"
                                                    method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger delete-btn"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="14" class="text-center">{{ __('No patterns found.') }}</td>
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

    {{-- SweetAlert Delete --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This pattern will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        btn.closest('form').submit();
                    }
                })
            });
        });
    </script>
@endsection
