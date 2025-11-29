@extends('layout.master')

@section('title', 'Add New Funding Plan')

@section('main_content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Add New Funding Plan</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('funding-plans.index') }}">Funding Plans</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Funding Plan Details</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('funding-plans.store') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Plan Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" placeholder="e.g. 20L" value="{{ old('title') }}" required>
                                    @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Capital Amount (₹) <span class="text-danger">*</span></label>
                                    <input type="number" name="capital" class="form-control" placeholder="2000000" value="{{ old('capital') }}" required>
                                    @error('capital') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Assessment Fee (₹) <span class="text-danger">*</span></label>
                                    <input type="number" name="fee" class="form-control" placeholder="37000" value="{{ old('fee') }}" required>
                                    @error('fee') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Profit Target <span class="text-danger">*</span></label>
                                    <input type="text" name="profit_target" class="form-control" placeholder="8%" value="{{ old('profit_target', '8%') }}" required>
                                    @error('profit_target') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Max Loss <span class="text-danger">*</span></label>
                                    <input type="text" name="max_loss" class="form-control" placeholder="6%" value="{{ old('max_loss', '6%') }}" required>
                                    @error('max_loss') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Drawdown Type <span class="text-danger">*</span></label>
                                    <select name="drawdown_type" class="form-select" required>
                                        <option value="Trailing" {{ old('drawdown_type') == 'Trailing' ? 'selected' : '' }}>Trailing</option>
                                        <option value="Static" {{ old('drawdown_type') == 'Static' ? 'selected' : '' }}>Static</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Payout Cycle</label>
                                    <input type="text" name="payout_cycle" class="form-control" placeholder="20 Days" value="{{ old('payout_cycle', '20 Days') }}">
                                </div>

                                <div class="col-12">
                                    <hr class="my-4">
                                    <h5>Trading Rules</h5>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="news_trading" value="1" id="news_trading" checked>
                                        <label class="form-check-label" for="news_trading">News Trading Allowed</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="weekend_holding" value="1" id="weekend_holding" checked>
                                        <label class="form-check-label" for="weekend_holding">Weekend Holding Allowed</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
                                        <label class="form-check-label" for="is_active">Plan is Active</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Sort Order (optional)</label>
                                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
                                </div>
                            </div>

                            <div class="mt-4 text-end">
                                <a href="{{ route('funding-plans.index') }}" class="btn btn-secondary me-2">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Save Plan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
