@extends('master')

@section('title', 'Payment Cancelled')

@section('content')
<div class="container py-5 min-vh-100 d-flex align-items-center">
    <div class="row justify-content-center w-100">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-lg border-0 text-center">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <i class="fas fa-window-close text-warning" style="font-size: 100px;"></i>
                    </div>

                    <h1 class="display-4 fw-bold text-warning mb-3">Payment Cancelled</h1>
                    <p class="lead text-muted mb-4">
                        You have cancelled the payment process.
                    </p>

                    @if(session('error'))
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="bg-light rounded-4 p-4 my-4">
                        <p class="mb-0">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            No charges have been made to your account.
                            You can try again anytime.
                        </p>
                    </div>

                    <div class="d-grid gap-3">
                        <a href="{{ url()->previous() }}" class="btn btn-warning btn-lg fw-bold py-3 text-dark">
                            <i class="fas fa-redo me-2"></i>Try Again
                        </a>
                        <a href="{{ url('/') }}" class="btn btn-outline-dark btn-lg">
                            <i class="fas fa-list me-2"></i>View All Plans
                        </a>
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-home me-2"></i>Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
