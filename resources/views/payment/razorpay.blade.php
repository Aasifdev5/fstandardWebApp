@extends('master')
@section('title') Razorpay Payment @endsection
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-warning text-white text-center py-4">
                    <h3 class="mb-0"><i class="fas fa-university me-2"></i>Razorpay Payment</h3>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="mb-4">
                        <h4 class="text-dark">Amount to Pay: ₹{{ number_format($purchase->amount, 2) }}</h4>
                        <p class="text-muted">Order ID: {{ $purchase->transaction_id }}</p>
                    </div>

                    <form action="{{ route('payment.callback.razorpay') }}" method="POST">
                        @csrf
                        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                        <input type="hidden" name="razorpay_order_id" value="{{ $razorpayOrder->id }}">
                        <input type="hidden" name="razorpay_signature" id="razorpay_signature">

                        <button type="button" id="rzp-button" class="btn btn-warning btn-lg w-100 py-3 fw-bold">
                            <i class="fas fa-lock me-2"></i>Pay ₹{{ number_format($purchase->amount, 2) }}
                        </button>
                    </form>

                    <p class="text-muted mt-3 small">
                        <i class="fas fa-shield-alt me-1"></i>Secure payment by Razorpay
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ env('RAZORPAY_KEY_ID') }}",
        "amount": "{{ $razorpayOrder->amount }}",
        "currency": "INR",
        "name": "{{ env('APP_NAME') }}",
        "description": "Plan Purchase",
        "image": "{{ asset('images/logo.png') }}",
        "order_id": "{{ $razorpayOrder->id }}",
        "handler": function (response){
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;
            document.querySelector('form').submit();
        },
        "prefill": {
            "name": "{{ Auth::user()->name ?? '' }}",
            "email": "{{ Auth::user()->email ?? '' }}",
            "contact": "9999999999"
        },
        "notes": {
            "purchase_id": "{{ $purchase->id }}"
        },
        "theme": {
            "color": "#F37254"
        }
    };

    var rzp1 = new Razorpay(options);

    document.getElementById('rzp-button').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    }

    // Auto open Razorpay
    rzp1.open();
</script>
@endsection
