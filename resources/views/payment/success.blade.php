@extends('master')

@section('title', 'Payment Successful!')

@section('content')
    <div class="container py-5 min-vh-100 d-flex align-items-center">
        <div class="row justify-content-center w-100">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-lg border-0 text-center">
                    <div class="card-body p-5">
                        <!-- Success Animation -->
                        <div class="mb-4">
                            <div class="success-checkmark">
                                <div class="check-icon">
                                    <span class="icon-line line-tip"></span>
                                    <span class="icon-line line-long"></span>
                                    <div class="icon-circle"></div>
                                    <div class="icon-fix"></div>
                                </div>
                            </div>
                        </div>

                        <h1 class="display-4 fw-bold text-success mb-3">Payment Successful!</h1>
                        <h4 class="text-dark mb-4">Congratulations, {{ $user_session->name }}!</h4>

                        @if ($latestPurchase)
                            <div class="alert alert-success border-0 shadow-sm">
                                <p class="mb-2 lead">
                                    You have successfully purchased the
                                    <strong>{{ $latestPurchase->plan->title ?? 'Funding' }} Plan</strong>
                                </p>
                                <p class="mb-2">
                                    Amount Paid: <strong
                                        class="text-success">₹{{ number_format($latestPurchase->amount, 2) }}</strong>
                                </p>
                                <p class="mb-0 small text-muted">
                                    Transaction ID: {{ $latestPurchase->transaction_id }}
                                </p>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <p class="mb-0">Purchase details not found. Please contact support.</p>
                            </div>
                        @endif

                        <div class="bg-light rounded-4 p-4 my-4">
                            <p class="text-muted mb-2">
                                <i class="fas fa-clock text-warning me-2"></i>
                                Your evaluation account will be <strong>activated within 24 hours</strong>
                            </p>
                            <p class="text-muted mb-0">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                Confirmation email has been sent to <strong>{{ $user_session->email }}</strong>
                            </p>
                        </div>

                        <div class="d-grid gap-3">
                            <a href="{{ url('/dashboard') }}" class="btn btn-success btn-lg fw-bold py-3">
                                <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                            </a>
                            <a href="{{ url('/') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Back to Plans
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .success-checkmark {
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }

        .check-icon {
            width: 120px;
            height: 120px;
            position: relative;
            border-radius: 50%;
            box-sizing: content-box;
            border: 6px solid #28a745;
        }

        .icon-line {
            height: 6px;
            background-color: #28a745;
            display: block;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
        }

        .line-tip {
            top: 56px;
            left: 20px;
            width: 35px;
            transform: rotate(45deg);
            animation: icon-line-tip 0.75s;
        }

        .line-long {
            top: 50px;
            right: 14px;
            width: 65px;
            transform: rotate(-45deg);
            animation: icon-line-long 0.75s;
        }

        .icon-circle {
            top: -6px;
            left: -6px;
            z-index: 9;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            position: absolute;
            box-sizing: content-box;
            animation: icon-circle 1.2s ease-in-out;
        }

        .icon-fix {
            top: 8px;
            width: 120px;
            left: 28px;
            position: absolute;
            z-index: 1;
        }

        @keyframes icon-line-tip {

            0%,
            54% {
                width: 0;
                left: 1px;
                top: 19px;
            }

            70% {
                width: 50px;
                left: -4px;
                top: 37px;
            }

            84% {
                width: 35px;
                left: 20px;
                top: 56px;
            }

            100% {
                width: 35px;
                left: 20px;
                top: 56px;
            }
        }

        @keyframes icon-line-long {

            0%,
            65% {
                width: 0;
                right: 46px;
                top: 54px;
            }

            84% {
                width: 65px;
                right: 14px;
                top: 50px;
            }

            100% {
                width: 65px;
                right: 14px;
                top: 50px;
            }
        }

        @keyframes icon-circle {
            0% {
                transform: scale(0);
            }

            60% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
@endsection
