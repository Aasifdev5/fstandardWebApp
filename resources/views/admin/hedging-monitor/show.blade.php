@extends('layout.master')
@section('title') Hedging Alert #{{ $monitor->id }} @endsection

@section('main_content')
<div class="page-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Hedging Monitor Record #{{ $monitor->id }}</h3>
                <a href="{{ route('hedging-monitor.index') }}" class="btn btn-secondary">Back</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>User A</th>
                                <td><strong>{{ $monitor->userA?->name }}</strong></td>
                            </tr>
                            <tr>
                                <th>User B</th>
                                <td><strong>{{ $monitor->userB?->name ?? '—' }}</strong></td>
                            </tr>
                            <tr>
                                <th>Hedging Score</th>
                                <td>
                                    <h4 class="mb-0 {{ $monitor->hedging_score >= 0.9 ? 'text-danger' : 'text-warning' }}">
                                        {{ number_format($monitor->hedging_score, 4) }}
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <th>Current Action</th>
                                <td>
                                    @if($monitor->action == 'fail')
                                        <span class="badge badge-danger">BLOCKED</span>
                                    @elseif($monitor->action == 'alert')
                                        <span class="badge badge-warning">ALERT</span>
                                    @else
                                        <span class="badge badge-secondary">None</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Detected At</th>
                                <td>{{ $monitor->created_at->format('d M Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Triggers ({{ count($monitor->triggers) }})</h5>
                        <pre class=" p-3 rounded small">{{ json_encode($monitor->triggers, JSON_PRETTY_PRINT) }}</pre>

                        <h5 class="mt-4">Evidence</h5>
                        @if($monitor->evidence && count($monitor->evidence) > 0)
                            <pre class=" p-3 rounded small">{{ json_encode($monitor->evidence, JSON_PRETTY_PRINT) }}</pre>
                        @else
                            <p class="text-muted">No evidence recorded</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
