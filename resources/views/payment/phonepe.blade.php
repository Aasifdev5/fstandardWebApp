@extends('master')
@section('title') PhonePe Payment @endsection
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-info text-white text-center py-4">
                    <h3 class="mb-0"><i class="fas fa-mobile-alt me-2"></i>PhonePe Payment</h3>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="mb-4">
                        <h4 class="text-dark">Amount to Pay: ₹{{ number_format($purchase->amount, 2) }}</h4>
                        <p class="text-muted">Transaction ID: {{ $purchase->transaction_id }}</p>
                    </div>

                    <div id="phonepe-container" class="mb-3">
                        <p>Redirecting to PhonePe...</p>
                        <div class="spinner-border text-info" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <form id="phonepe-form" action="{{ $baseUrl }}/pg/v1/pay" method="POST">
                        <input type="hidden" name="request" value="{{ $requestData['request'] }}">
                        <input type="hidden" name="checksum" value="{{ $checksum }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-submit form to redirect to PhonePe
        document.getElementById('phonepe-form').submit();
    });
</script>
@endsection
