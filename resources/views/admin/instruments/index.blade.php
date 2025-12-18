@extends('layout.master')
@section('title')
    Instruments
@endsection

@section('main_content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h2>Instruments</h2>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <a href="{{ route('instruments.create') }}" class="btn btn-primary">
                            Add New Instrument
                        </a>
                        <a href="{{ route('instruments.import.form') }}" class="btn btn-success ms-2">
                            Import CSV
                        </a>

                        <button id="bulk-delete" class="btn btn-danger ms-2" disabled>
                            Delete Selected
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table id="basic-1" class="row-border data-table-filter table-style">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>#</th>
                                    <th>Symbol</th>
                                    <th>Category</th>
                                    <th>Sector</th>
                                    <th>Base Price</th>
                                    <th>Volatility</th>
                                    <th>Tick Size</th>
                                    <th>Lot Size</th>
                                    <th>Session</th>
                                    <th>News Sensitivity</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($instruments as $instrument)
                                    <tr class="removable-item">
                                        <td><input type="checkbox" class="record-checkbox" value="{{ $instrument->id }}">
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $instrument->symbol }}</strong></td>
                                        <td>{{ ucfirst($instrument->category) }}</td>
                                        <td>{{ $instrument->sector }}</td>
                                        <td>{{ number_format($instrument->base_price, 2) }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $instrument->volatility_class == 'very_high'
                                                    ? 'badge-danger'
                                                    : ($instrument->volatility_class == 'high'
                                                        ? 'badge-warning'
                                                        : ($instrument->volatility_class == 'medium'
                                                            ? 'badge-info'
                                                            : 'badge-secondary')) }}">
                                                {{ ucwords(str_replace('_', ' ', $instrument->volatility_class)) }}
                                            </span>
                                        </td>
                                        <td>{{ $instrument->tick_size }}</td>
                                        <td>{{ $instrument->lot_size }}</td>
                                        <td>{{ $instrument->session_start }} - {{ $instrument->session_end }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $instrument->news_sensitivity == 'very_high'
                                                    ? 'badge-danger'
                                                    : ($instrument->news_sensitivity == 'high'
                                                        ? 'badge-warning'
                                                        : ($instrument->news_sensitivity == 'medium'
                                                            ? 'badge-info'
                                                            : 'badge-secondary')) }}">
                                                {{ ucwords(str_replace('_', ' ', $instrument->news_sensitivity)) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($instrument->is_active)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('instruments.edit', $instrument) }}"
                                                class="btn btn-icon btn-info">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="btn btn-icon btn-danger delete-record"
                                                data-url="{{ route('instruments.destroy', $instrument) }}">
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

    @include('admin.partials.delete-script', [
        'bulkUrl' => route('instruments.bulk-delete'),
    ])
@endsection
