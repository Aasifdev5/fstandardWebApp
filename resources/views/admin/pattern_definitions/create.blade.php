@extends('layout.master')

@section('title')
    {{ __('Create Pattern Definition') }}
@endsection

@section('main_content')
<div class="page-content">
    <div class="container-fluid">

        {{-- Breadcrumb --}}
        <div class="row mb-3">
            <div class="col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pattern-definitions.index') }}">{{ __('Pattern Definitions') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Create') }}</li>
                </ol>
            </div>
        </div>

        {{-- Form --}}
        <div class="row">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>{{ __('Add New Pattern Definition') }}</h5>
                    </div>
                    <form method="POST" action="{{ route('pattern-definitions.store') }}">
                        @csrf
                        <div class="card-body row">
                            @include('admin.pattern_definitions.form-fields')
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary"><i class="fas fa-save me-1"></i>{{ __('Save') }}</button>
                            <a href="{{ route('pattern-definitions.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
