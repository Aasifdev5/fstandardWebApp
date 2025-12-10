@extends('layout.master')
@section('title') Delayed Feed Assignment #{{ $assignment->id }} @endsection

@section('main_content')
<div class="page-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Delayed Feed Assignment #{{ $assignment->id }}</h3>
                <a href="{{ route('delayed-feed-assignments.index') }}" class="btn btn-secondary">Back</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">User</th>
                        <td><strong>{{ $assignment->user?->name }}</strong></td>
                    </tr>
                    <tr>
                        <th>Delay (seconds)</th>
                        <td><strong class="text-danger">{{ $assignment->delay_seconds }} sec</strong></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            {!! $assignment->active
                                ? '<span class="badge badge-success">Active</span>'
                                : '<span class="badge badge-secondary">Inactive</span>' !!}
                        </td>
                    </tr>
                    <tr>
                        <th>Reason</th>
                        <td>{{ $assignment->reason ?? '<em class="text-muted">No reason provided</em>' }}</td>
                    </tr>
                    <tr>
                        <th>Assigned At</th>
                        <td>{{ $assignment->assigned_at?->format('d M Y H:i:s') ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $assignment->created_at->format('d M Y H:i:s') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
