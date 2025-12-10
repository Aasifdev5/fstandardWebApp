@extends('layout.master')
@section('title') Blockchain Record #{{ $record->id }} @endsection

@section('main_content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Blockchain Hash Record #{{ $record->id }}</h3>
                        <a href="{{ route('blockchain-hash-records.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">User</th>
                                        <td><strong>{{ $record->user?->name ?? '—' }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <td>{{ $record->for_date->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Chain</th>
                                        <td><span class="badge badge-info">{{ $record->chain ?? '—' }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>TX Hash</th>
                                        <td><code class="small">{{ $record->tx_hash ?? '—' }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Behaviour Metrics Hash</th>
                                        <td><code class="small">{{ $record->behaviour_metrics_hash }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Recorded At</th>
                                        <td>{{ $record->created_at->format('d M Y H:i:s') }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5>Meta Data</h5>
                                @if($record->meta && count($record->meta) > 0)
                                    <pre class=" p-3 rounded">{{ json_encode($record->meta, JSON_PRETTY_PRINT) }}</pre>
                                @else
                                    <p class="text-muted">No additional metadata</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
