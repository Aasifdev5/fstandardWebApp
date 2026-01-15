@extends('layout.master')

@section('title')
    {{ __('Admin Analytics Dashboard') }}
@endsection

@section('main_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- Flash Messages -->
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(Session::has('fail') || Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('fail') ?? session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">{{ __('Analytics & Cycle Forecasts') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Analytics Dashboard') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Forecast Card -->
        @if($latest)
            <div class="row mb-4">
                <div class="col-xl-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-chart-trending-up me-2"></i>
                                {{ __('Latest Forecast') }} — {{ strtoupper($latest->cycle_type) }} Cycle ({{ $latest->cycle_id }})
                            </h5>
                            <small class="opacity-75">
                                Generated: {{ \Carbon\Carbon::parse($latest->generated_at)->format('d M Y, H:i') }}
                            </small>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3 mb-4">
                                    <div class="p-4  rounded-3">
                                        <h6 class="text-muted mb-2">{{ __('Expected Pass Rate') }}</h6>
                                        <h3 class="mb-0 text-primary">
                                            {{ number_format($latest->expected_pass_rate ?? 0, 2) }}%
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="p-4  rounded-3">
                                        <h6 class="text-muted mb-2">{{ __('Payout Pressure') }}</h6>
                                        <h3 class="mb-0 text-warning">
                                            {{ number_format($latest->expected_payout_pressure ?? 0, 2) }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="p-4  rounded-3">
                                        <h6 class="text-muted mb-2">{{ __('Risk Band') }}</h6>
                                        <h3 class="mb-0 fw-bold
                                            @if($latest->risk_band === 'CRITICAL') text-danger
                                            @elseif($latest->risk_band === 'HIGH') text-warning
                                            @elseif($latest->risk_band === 'MODERATE') text-orange
                                            @else text-success
                                            @endif">
                                            {{ $latest->risk_band ?? 'UNKNOWN' }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="p-4  rounded-3">
                                        <h6 class="text-muted mb-2">{{ __('Input Metrics Used') }}</h6>
                                        <small class="d-block">Avg Confidence: {{ number_format($latest->inputs['avg_psychometric_confidence'] ?? 0, 4) }}</small>
                                        <small class="d-block">Discipline Variance: {{ number_format($latest->inputs['discipline_variance'] ?? 0, 4) }}</small>
                                        <small class="d-block">Active Patterns (24h): {{ $latest->inputs['active_patterns'] ?? 0 }}</small>
                                        <small class="d-block">Risk Exposure Ratio: {{ number_format($latest->inputs['risk_exposure_ratio'] ?? 0, 4) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                {{ __('No forecast generated yet. Run the analytics command or wait for scheduled run.') }}
            </div>
        @endif

        <!-- Historical Forecasts Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            <i class="fas fa-history me-2"></i>
                            {{ __('Historical Forecasts') }} (Last 30 Cycles)
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-1" class="table table-hover table-centered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <th>{{ __('Cycle Type') }}</th>
                                        <th>{{ __('Cycle ID') }}</th>
                                        <th>{{ __('Pass Rate %') }}</th>
                                        <th>{{ __('Payout Pressure') }}</th>
                                        <th>{{ __('Risk Band') }}</th>
                                        <th>{{ __('Generated') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($history as $index => $forecast)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><strong>{{ strtoupper($forecast->cycle_type) }}</strong></td>
                                            <td>{{ $forecast->cycle_id }}</td>
                                            <td>{{ number_format($forecast->expected_pass_rate ?? 0, 2) }}%</td>
                                            <td>{{ number_format($forecast->expected_payout_pressure ?? 0, 2) }}</td>
                                            <td>
                                                <span class="badge rounded-pill
                                                    @if($forecast->risk_band === 'CRITICAL') bg-danger
                                                    @elseif($forecast->risk_band === 'HIGH') bg-warning text-dark
                                                    @elseif($forecast->risk_band === 'MODERATE') bg-orange text-dark
                                                    @else bg-success
                                                    @endif">
                                                    {{ $forecast->risk_band ?? 'UNKNOWN' }}
                                                </span>
                                            </td>
                                            <td>{{ $forecast->generated_at ? \Carbon\Carbon::parse($forecast->generated_at)->diffForHumans() : 'N/A' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-5">
                                                <i class="fas fa-inbox fa-3x mb-3"></i><br>
                                                {{ __('No historical forecasts available yet.') }}
                                            </td>
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
</div>
@endsection

@section('css')
<style>
    .bg-orange {
        background-color: #fd7e14 !important;
    }
    .text-orange {
        color: #fd7e14 !important;
    }
</style>
@endsection
