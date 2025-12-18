@extends('layout.master')
@section('title') Edit Instrument: {{ $instrument->symbol }} @endsection

@section('main_content')
<div class="page-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Edit Instrument: <strong>{{ $instrument->symbol }}</strong></h2>
            </div>
            <div class="card-body">
                <form action="{{ route('instruments.update', $instrument) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="symbol">Symbol <span class="text-danger">*</span></label>
                                <input type="text" name="symbol" id="symbol" class="form-control @error('symbol') is-invalid @enderror"
                                       value="{{ old('symbol', $instrument->symbol) }}" required>
                                @error('symbol')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="category">Category <span class="text-danger">*</span></label>
                                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                                    <option value="index" {{ old('category', $instrument->category) == 'index' ? 'selected' : '' }}>Index</option>
                                    <option value="stock" {{ old('category', $instrument->category) == 'stock' ? 'selected' : '' }}>Stock</option>
                                    <option value="commodity" {{ old('category', $instrument->category) == 'commodity' ? 'selected' : '' }}>Commodity</option>
                                </select>
                                @error('category')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="sector">Sector <span class="text-danger">*</span></label>
                                <input type="text" name="sector" id="sector" class="form-control @error('sector') is-invalid @enderror"
                                       value="{{ old('sector', $instrument->sector) }}" required>
                                @error('sector')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="base_price">Base Price <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="base_price" id="base_price"
                                       class="form-control @error('base_price') is-invalid @enderror"
                                       value="{{ old('base_price', $instrument->base_price) }}" required>
                                @error('base_price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="volatility_class">Volatility Class <span class="text-danger">*</span></label>
                                <select name="volatility_class" id="volatility_class" class="form-control @error('volatility_class') is-invalid @enderror" required>
                                    <option value="low" {{ old('volatility_class', $instrument->volatility_class) == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('volatility_class', $instrument->volatility_class) == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ old('volatility_class', $instrument->volatility_class) == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="very_high" {{ old('volatility_class', $instrument->volatility_class) == 'very_high' ? 'selected' : '' }}>Very High</option>
                                </select>
                                @error('volatility_class')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="news_sensitivity">News Sensitivity <span class="text-danger">*</span></label>
                                <select name="news_sensitivity" id="news_sensitivity" class="form-control @error('news_sensitivity') is-invalid @enderror" required>
                                    <option value="low" {{ old('news_sensitivity', $instrument->news_sensitivity) == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('news_sensitivity', $instrument->news_sensitivity) == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ old('news_sensitivity', $instrument->news_sensitivity) == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="very_high" {{ old('news_sensitivity', $instrument->news_sensitivity) == 'very_high' ? 'selected' : '' }}>Very High</option>
                                </select>
                                @error('news_sensitivity')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="tick_size">Tick Size <span class="text-danger">*</span></label>
                                <input type="number" step="0.0001" name="tick_size" id="tick_size"
                                       class="form-control @error('tick_size') is-invalid @enderror"
                                       value="{{ old('tick_size', $instrument->tick_size) }}" required>
                                @error('tick_size')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="lot_size">Lot Size <span class="text-danger">*</span></label>
                                <input type="number" name="lot_size" id="lot_size"
                                       class="form-control @error('lot_size') is-invalid @enderror"
                                       value="{{ old('lot_size', $instrument->lot_size) }}" required>
                                @error('lot_size')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="is_active">Status</label>
                                <select name="is_active" id="is_active" class="form-control">
                                    <option value="1" {{ old('is_active', $instrument->is_active) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !old('is_active', $instrument->is_active) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="session_start">Session Start <span class="text-danger">*</span></label>
                                <input type="time" name="session_start" id="session_start"
                                       class="form-control @error('session_start') is-invalid @enderror"
                                       value="{{ old('session_start', $instrument->session_start) }}" required>
                                @error('session_start')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="session_end">Session End <span class="text-danger">*</span></label>
                                <input type="time" name="session_end" id="session_end"
                                       class="form-control @error('session_end') is-invalid @enderror"
                                       value="{{ old('session_end', $instrument->session_end) }}" required>
                                @error('session_end')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success btn-lg">Update Instrument</button>
                        <a href="{{ route('instruments.index') }}" class="btn btn-secondary btn-lg ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
