@extends('layout.master')

@section('title')
    {{ __('Manual Pattern Control') }}
@endsection

@section('main_content')
<div class="page-content">
    <div class="container-fluid">

        {{-- SweetAlert Flash --}}
        @if(Session::has('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    timer: 2500,
                    showConfirmButton: false
                });
            </script>
        @endif

        @if(Session::has('fail'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('fail') }}',
                    timer: 2500,
                    showConfirmButton: false
                });
            </script>
        @endif

        {{-- Header --}}
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>{{ __('Inject Market Pattern') }}</h4>
                </div>
            </div>
        </div>

        {{-- Injection Form --}}
        <div class="row">
            <div class="col-xl-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('patterns.store') }}">
                            @csrf
                            <div class="row">

                                {{-- Pattern --}}
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Pattern</label>
                                    <select name="pattern_definition_id" class="form-select" required>
                                        @foreach($patterns as $pattern)
                                            <option value="{{ $pattern->id }}">{{ $pattern->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Instrument --}}
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Instrument</label>
                                    <select name="instrument_id" class="form-select" required>
                                        @foreach($instruments as $instrument)
                                            <option value="{{ $instrument->id }}">{{ $instrument->symbol }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Timeframe --}}
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Timeframe</label>
                                    <select name="timeframe" class="form-select">
                                        @foreach($timeframes as $tf)
                                            <option value="{{ $tf }}">{{ $tf }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Strength --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Strength (0.4 – 0.95)</label>
                                    <input type="range" name="strength" min="0.4" max="0.95" step="0.01"
                                           value="0.7" class="form-range"
                                           oninput="document.getElementById('strengthVal').innerText=this.value">
                                    <small>Selected: <strong id="strengthVal">0.7</strong></small>
                                </div>

                                {{-- Start / End --}}
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Start At</label>
                                    <input type="datetime-local" name="start_at" class="form-control">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">End At</label>
                                    <input type="datetime-local" name="end_at" class="form-control">
                                </div>

                                {{-- Fractals --}}
                                <div class="col-md-12 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="generate_fractals" value="1">
                                        <label class="form-check-label">
                                            Generate fractal patterns on nearby timeframes
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12 text-end">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-bolt me-1"></i> Generate Pattern
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Injected Patterns List --}}
        <div class="row">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Injected Patterns</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="basic-1" class="table table-bordered table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Pattern</th>
                                    <th>Instrument</th>
                                    <th>Timeframe</th>
                                    <th>Strength</th>
                                    <th>Confidence</th>
                                    <th>Source</th>
                                    <th>Active</th>
                                    <th>Start At</th>
                                    <th>End At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($injectedPatterns as $p)
                                    <tr>
                                        <td>{{ $p->id }}</td>
                                        <td>{{ $p->patternDefinition->name ?? '-' }}</td>
                                        <td>{{ $p->instrument->symbol ?? '-' }}</td>
                                        <td>{{ $p->timeframe }}</td>
                                        <td>{{ $p->strength }}</td>
                                        <td>{{ $p->confidence }}</td>
                                        <td>{{ $p->source }}</td>
                                        <td>
                                            @if($p->is_active)
                                                <span class="badge bg-success">Yes</span>
                                            @else
                                                <span class="badge bg-danger">No</span>
                                            @endif
                                        </td>
                                        <td>{{ $p->starts_at }}</td>
                                        <td>{{ $p->ends_at }}</td>
                                        <td>
                                            <form action="{{ route('patterns.destroy', $p->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger delete-btn">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">No injected patterns found.</td>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function () {
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
