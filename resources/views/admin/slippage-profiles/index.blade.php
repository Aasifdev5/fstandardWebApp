@extends('layout.master')
@section('title') Slippage Profiles @endsection

@section('main_content')
<div class="page-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header"><h2>Slippage Profiles</h2></div>
            <div class="card-body">
                <button id="bulk-delete" class="btn btn-danger mb-3" disabled>Delete Selected</button>
                <div class="table-responsive">
                    <table id="basic-1" class="row-border data-table-filter table-style">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>#</th>
                                <th>User</th>
                                <th>Min/Max Slippage</th>
                                <th>Overrides</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profiles as $p)
                            <tr class="removable-item">
                                <td><input type="checkbox" class="record-checkbox" value="{{ $p->id }}"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->user?->name }}</td>
                                <td>{{ $p->min_slippage }} – {{ $p->max_slippage }}</td>
                                <td>
                                    {{ count($p->symbol_overrides ?? []) + count($p->time_overrides ?? []) }} override(s)
                                </td>
                                <td>{!! $p->active ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' !!}</td>
                                <td>
                                    <a href="{{ route('slippage-profiles.show', $p) }}" class="btn btn-icon btn-info"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-icon btn-danger delete-record"
                                       data-url="{{ route('slippage-profiles.destroy', $p) }}"><i class="fa fa-trash"></i></a>
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
    'bulkUrl' => route('slippage-profiles.bulk-delete')
])
@endsection
