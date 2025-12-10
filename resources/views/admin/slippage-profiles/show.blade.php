@extends('layout.master')
@section('title') Slippage Profile #{{ $profile->id }} @endsection

@section('main_content')
<div class="page-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Slippage Profile #{{ $profile->id }}</h3>
                <a href="{{ route('slippage-profiles.index') }}" class="btn btn-secondary">Back</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">User</th>
                                <td><strong>{{ $profile->user?->name }}</strong></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    {!! $profile->active
                                        ? '<span class="badge badge-success">Active</span>'
                                        : '<span class="badge badge-danger">Inactive</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <th>Min Slippage</th>
                                <td>{{ $profile->min_slippage }}</td>
                            </tr>
                            <tr>
                                <th>Max Slippage</th>
                                <td><strong class="text-primary">{{ $profile->max_slippage }}</strong></td>
                            </tr>
                            <tr>
                                <th>Created</th>
                                <td>{{ $profile->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Updated</th>
                                <td>{{ $profile->updated_at->diffForHumans() }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Symbol Overrides</h5>
                        @if($profile->symbol_overrides && count($profile->symbol_overrides) > 0)
                            <pre class=" p-3 rounded small">{{ json_encode($profile->symbol_overrides, JSON_PRETTY_PRINT) }}</pre>
                        @else
                            <p class="text-muted">No symbol overrides</p>
                        @endif

                        <h5 class="mt-4">Time-based Overrides</h5>
                        @if($profile->time_overrides && count($profile->time_overrides) > 0)
                            <pre class=" p-3 rounded small">{{ json_encode($profile->time_overrides, JSON_PRETTY_PRINT) }}</pre>
                        @else
                            <p class="text-muted">No time overrides</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
