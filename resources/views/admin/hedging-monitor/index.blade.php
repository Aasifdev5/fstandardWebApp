@extends('layout.master')
@section('title') Hedging Monitor @endsection

@section('main_content')
<div class="page-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header"><h2>Hedging Monitor</h2></div>
            <div class="card-body">
                <button id="bulk-delete" class="btn btn-danger mb-3" disabled>Delete Selected</button>
                <div class="table-responsive">
                    <table id="basic-1" class="row-border data-table-filter table-style">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>#</th>
                                <th>User A</th>
                                <th>User B</th>
                                <th>Score</th>
                                <th>Action</th>
                                <th>Triggers</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($monitors as $m)
                            <tr class="removable-item">
                                <td><input type="checkbox" class="record-checkbox" value="{{ $m->id }}"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $m->userA?->name }}</td>
                                <td>{{ $m->userB?->name ?? '—' }}</td>
                                <td><strong>{{ number_format($m->hedging_score, 4) }}</strong></td>
                                <td>
                                    @if($m->action == 'fail') <span class="badge badge-danger">Blocked</span>
                                    @elseif($m->action == 'alert') <span class="badge badge-warning">Alert</span>
                                    @else <span class="badge badge-secondary">None</span> @endif
                                </td>
                                <td>{{ count($m->triggers) }} trigger(s)</td>
                                <td>
                                    <a href="{{ route('hedging-monitor.show', $m) }}" class="btn btn-icon btn-info"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-icon btn-danger delete-record"
                                       data-url="{{ route('hedging-monitor.destroy', $m) }}"><i class="fa fa-trash"></i></a>
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

@include('admin.partials.delete-script', [
    'bulkUrl' => route('hedging-monitor.bulk-delete')
])
@endsection
