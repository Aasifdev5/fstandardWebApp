@extends('layout.master')

@section('title', __('Market Simulation & Pricing'))

@section('main_content')
<div class="container-fluid pt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>{{ __('Success!') }}</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="alert alert-warning mt-3">
        <i class="fa fa-exclamation-triangle"></i>
        <strong>{{ __('Warning:') }}</strong> {{ __('Changes affect live pricing and simulation engine immediately.') }}
    </div>

    <form action="{{ route('simulation-config.update') }}" method="POST">
        @csrf

        <div class="card shadow-sm mt-4 border-primary">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fa fa-money"></i> {{ __('Global Pricing Constants') }}</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">{{ __('Base Rupee Per Point') }}</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" step="0.01" name="base_rupee_per_point" class="form-control"
                                   value="{{ old('base_rupee_per_point', $config['base_rupee_per_point'] ?? 75) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('Reference Price') }}</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" step="0.01" name="reference_price" class="form-control"
                                   value="{{ old('reference_price', $config['reference_price'] ?? 24000) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('Reference Account Size') }}</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" step="1" name="reference_account" class="form-control"
                                   value="{{ old('reference_account', $config['reference_account'] ?? 1000000) }}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm mt-4 border-success">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fa fa-cubes"></i> {{ __('Lot Multipliers') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('Lot Type') }}</th>
                                        <th>{{ __('Multiplier') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(['micro', 'mini', 'standard', 'large', 'mega'] as $lot)
                                    <tr>
                                        <td class="fw-bold text-capitalize">{{ $lot }}</td>
                                        <td>
                                            <input type="number" step="0.01"
                                                   name="lot_multipliers[{{ $lot }}]"
                                                   class="form-control form-control-sm"
                                                   value="{{ old('lot_multipliers.'.$lot, $config['lot_multipliers'][$lot] ?? 1.0) }}" required>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm mt-4 border-info">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0"><i class="fa fa-line-chart"></i> {{ __('Instrument Multipliers') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered table-sm">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th>{{ __('Symbol') }}</th>
                                        <th>{{ __('Multiplier') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Loop through the known list passed from controller --}}
                                    @foreach($knownInstruments as $symbol)
                                    <tr>
                                        <td class="fw-bold">{{ $symbol }}</td>
                                        <td>
                                            <input type="number" step="0.01"
                                                   name="instrument_multipliers[{{ $symbol }}]"
                                                   class="form-control form-control-sm"
                                                   value="{{ old('instrument_multipliers.'.$symbol, $config['instrument_multipliers'][$symbol] ?? 1.0) }}" required>
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

        <h4 class="mt-5 mb-3 text-muted border-bottom pb-2">{{ __('Engine Simulation Settings') }}</h4>

        <div class="card mb-4 border-secondary">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">{{ __('Base Volatility by Class') }}</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @foreach(['low', 'medium', 'high', 'very_high'] as $class)
                    <div class="col-md-3">
                        <label class="form-label text-capitalize">{{ __($class) }}</label>
                        <input type="number" step="0.01" name="volatility_by_class[{{ $class }}]"
                               class="form-control"
                               value="{{ old('volatility_by_class.'.$class, $config['volatility_by_class'][$class] ?? 0) }}" required>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card mb-4 border-secondary">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">{{ __('Time of Day Multipliers') }}</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @foreach($config['time_of_day_multipliers'] ?? [] as $key => $val)
                    <div class="col-md-4">
                        <label class="form-label text-capitalize">{{ str_replace('_', ' ', $key) }}</label>
                        <input type="number" step="0.1" name="time_of_day_multipliers[{{ $key }}]"
                               class="form-control"
                               value="{{ old('time_of_day_multipliers.'.$key, $val) }}" required>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card mb-4 border-secondary">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">{{ __('Market Regimes') }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('Regime') }}</th>
                                <th>{{ __('Drift') }}</th>
                                <th>{{ __('Vol Mult') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(['normal', 'trend_up', 'trend_down', 'high_volatility', 'crash'] as $regime)
                            <tr>
                                <td class="fw-bold text-capitalize">{{ str_replace('_', ' ', $regime) }}</td>
                                <td>
                                    <input type="number" step="0.01" name="regimes[{{ $regime }}][drift]"
                                           class="form-control form-control-sm"
                                           value="{{ old('regimes.'.$regime.'.drift', $config['regimes'][$regime]['drift'] ?? 0) }}">
                                </td>
                                <td>
                                    <input type="number" step="0.1" name="regimes[{{ $regime }}][volatility_multiplier]"
                                           class="form-control form-control-sm"
                                           value="{{ old('regimes.'.$regime.'.volatility_multiplier', $config['regimes'][$regime]['volatility_multiplier'] ?? 1) }}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="text-center pb-5">
            <button type="submit" class="btn btn-primary btn-lg px-5">
                <i class="fa fa-save"></i> {{ __('Save All Configurations') }}
            </button>
        </div>

    </form>
</div>
@endsection
