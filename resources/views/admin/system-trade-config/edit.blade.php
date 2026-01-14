@extends('layout.master')

@section('title', __('System Trade Config'))

@section('main_content')
<div class="container-fluid pt-4">


    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>{{ __('Success!') }}</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Warning Alert -->
    <div class="alert alert-warning mt-3">
        <i class="fa fa-exclamation-triangle"></i>
        <strong>{{ __('Warning:') }}</strong> {{ __('Be careful when configuring this. Misconfiguration may result in loss of funds.') }}
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <form action="{{ route('system-trade-config.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Buy Order Config -->
                <div class="card mb-4 border-primary">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fa fa-arrow-up text-success"></i> {{ __('Buy Order Config') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">{{ __('Max Buy Order') }}</label>
                                <input type="number" name="max_buy_order" class="form-control" value="{{ old('max_buy_order', $config->max_buy_order) }}" min="1" max="100" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">{{ __('Min Decrease (%)') }}</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="min_decrease" class="form-control" value="{{ old('min_decrease', $config->min_decrease) }}" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">{{ __('Max Decrease (%)') }}</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="max_decrease" class="form-control" value="{{ old('max_decrease', $config->max_decrease) }}" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">{{ __('Order Amount Range (%)') }}</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="buy_order_amount_range" class="form-control" value="{{ old('buy_order_amount_range', $config->buy_order_amount_range) }}" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">{{ __('Order Matching Chance (%)') }}</label>
                                <div class="input-group">
                                    <input type="number" name="buy_order_matching_chance" class="form-control" value="{{ old('buy_order_matching_chance', $config->buy_order_matching_chance) }}" min="0" max="100" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">{{ __('Price Increase Up To (%)') }}</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="buy_order_matching_price_increase_up_to" class="form-control" value="{{ old('buy_order_matching_price_increase_up_to', $config->buy_order_matching_price_increase_up_to) }}" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">{{ __('Matching With System Trade') }}</label>
                                <select name="buy_matching_with_system_trade" class="form-select">
                                    <option value="no" {{ $config->buy_matching_with_system_trade === 'no' ? 'selected' : '' }}>No</option>
                                    <option value="yes" {{ $config->buy_matching_with_system_trade === 'yes' ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">{{ __('Order Remains (Minutes)') }}</label>
                                <div class="input-group">
                                    <input type="number" name="buy_order_remains_minutes" class="form-control" value="{{ old('buy_order_remains_minutes', $config->buy_order_remains_minutes) }}" min="1" required>
                                    <span class="input-group-text">Min</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sell Order Config -->
                <div class="card mb-4 border-danger">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0"><i class="fa fa-arrow-down text-warning"></i> {{ __('Sell Order Config') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">{{ __('Max Sell Order') }}</label>
                                <input type="number" name="max_sell_order" class="form-control" value="{{ old('max_sell_order', $config->max_sell_order) }}" min="1" max="100" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">{{ __('Min Increase (%)') }}</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="min_increase" class="form-control" value="{{ old('min_increase', $config->min_increase) }}" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">{{ __('Max Increase (%)') }}</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="max_increase" class="form-control" value="{{ old('max_increase', $config->max_increase) }}" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">{{ __('Order Amount Range (%)') }}</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="sell_order_amount_range" class="form-control" value="{{ old('sell_order_amount_range', $config->sell_order_amount_range) }}" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">{{ __('Order Matching Chance (%)') }}</label>
                                <div class="input-group">
                                    <input type="number" name="sell_order_matching_chance" class="form-control" value="{{ old('sell_order_matching_chance', $config->sell_order_matching_chance) }}" min="0" max="100" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">{{ __('Price Decrease Up To (%)') }}</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="sell_order_matching_price_decrease_up_to" class="form-control" value="{{ old('sell_order_matching_price_decrease_up_to', $config->sell_order_matching_price_decrease_up_to) }}" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">{{ __('Matching With System Trade') }}</label>
                                <select name="sell_matching_with_system_trade" class="form-select">
                                    <option value="no" {{ $config->sell_matching_with_system_trade === 'no' ? 'selected' : '' }}>No</option>
                                    <option value="yes" {{ $config->sell_matching_with_system_trade === 'yes' ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">{{ __('Order Remains (Minutes)') }}</label>
                                <div class="input-group">
                                    <input type="number" name="sell_order_remains_minutes" class="form-control" value="{{ old('sell_order_remains_minutes', $config->sell_order_remains_minutes) }}" min="1" required>
                                    <span class="input-group-text">Min</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="fa fa-save"></i> {{ __('Update Configuration') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
