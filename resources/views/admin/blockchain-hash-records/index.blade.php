@extends('layout.master')
@section('title') Blockchain Hash Records @endsection

@section('main_content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Blockchain Hash Records</h2>
                    </div>
                    <div class="card-body">
                        <button id="bulk-delete" class="btn btn-danger mb-3" disabled>
                            <i class="fas fa-trash-alt"></i> Delete Selected
                        </button>

                        <div class="table-responsive">
                            <table id="basic-1" class="row-border data-table-filter table-style">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select-all"></th>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Chain</th>
                                        <th>TX Hash</th>
                                        <th>Metrics Hash</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $record)
                                    <tr class="removable-item">
                                        <td><input type="checkbox" class="record-checkbox" value="{{ $record->id }}"></td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $record->user?->name ?? '—' }}</td>
                                        <td>{{ $record->for_date->format('d M Y') }}</td>
                                        <td><span class="badge badge-info">{{ $record->chain ?? '—' }}</span></td>
                                        <td><code>{{ Str::limit($record->tx_hash, 16) }}</code></td>
                                        <td><code>{{ Str::limit($record->behaviour_metrics_hash, 16) }}</code></td>
                                        <td>
                                            <a href="{{ route('blockchain-hash-records.show', $record) }}" class="btn btn-icon btn-info">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="btn btn-icon btn-danger delete-record"
                                               data-url="{{ route('blockchain-hash-records.destroy', $record) }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.delete-script', [
    'bulkUrl' => route('blockchain-hash-records.bulk-delete')
])
@endsection
