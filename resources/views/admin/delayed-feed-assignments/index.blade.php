@extends('layout.master')
@section('title') Delayed Feed Assignments @endsection

@section('main_content')
<div class="page-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header"><h2>Delayed Feed Assignments</h2></div>
            <div class="card-body">
                <button id="bulk-delete" class="btn btn-danger mb-3" disabled>Delete Selected</button>
                <div class="table-responsive">
                    <table id="basic-1" class="row-border data-table-filter table-style">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>#</th>
                                <th>User</th>
                                <th>Delay (sec)</th>
                                <th>Reason</th>
                                <th>Active</th>
                                <th>Assigned At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignments as $a)
                            <tr class="removable-item">
                                <td><input type="checkbox" class="record-checkbox" value="{{ $a->id }}"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $a->user?->name }}</td>
                                <td><strong>{{ $a->delay_seconds }}</strong></td>
                                <td>{{ Str::limit($a->reason, 40) }}</td>
                                <td>{!! $a->active ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-secondary">No</span>' !!}</td>
                                <td>{{ $a->assigned_at?->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('delayed-feed-assignments.show', $a) }}" class="btn btn-icon btn-info"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-icon btn-danger delete-record"
                                       data-url="{{ route('delayed-feed-assignments.destroy', $a) }}"><i class="fa fa-trash"></i></a>
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
    'bulkUrl' => route('delayed-feed-assignments.bulk-delete')
])
@endsection
