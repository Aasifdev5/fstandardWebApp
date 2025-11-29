@extends('master')

@section('title', 'Payment Failed')

@section('content')
<div class="container py-5 min-vh-100 d-flex align-items-center">
    <div class="row justify-content-center w-100">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-lg border-0 text-center">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <i class="fas fa-times-circle text-danger" style="font-size: 100px;"></i>
                    </div>

                    <h1 class="display-4 fw-bold text-danger mb-3">Payment Failed</h1>
                    <p class="lead text-muted mb-4">
                        We couldn't process your payment at this time.
                    </p>

                    @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="alert alert-warning">
                        <strong>Possible Reasons:</strong>
                        <ul class="text-start mt-2 mb-0">
                            <li>Insufficient funds</li>
                            <li>Card declined by bank</li>
                            <li>Internet connection issue</li>
                            <li>Payment gateway timeout</li>
                            <li>Incorrect card details</li>
                        </ul>
                    </div>

                    <p class="text-muted">
                        Don't worry! No amount has been deducted if the payment failed.
                    </p>

                    <div class="d-grid gap-3 mt-4">
                        <a href="{{ url()->previous() }}" class="btn btn-danger btn-lg fw-bold py-3">
                            <i class="fas fa-credit-card me-2"></i>Try Payment Again
                        </a>
                        <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Choose Another Plan
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-link text-muted">
                            <i class="fas fa-headset me-2"></i>Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .alert ul {
        margin-bottom: 0;
    }
    .alert ul li {
        margin-bottom: 5px;
    }
</style>
@endsection
