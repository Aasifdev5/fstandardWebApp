@extends('master')
@section('title', 'Affiliate Dashboard')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h1 class="display-5">Welcome back, {{ $user->first_name }}!</h1>
            <p class="lead">You're crushing it as an F Standard Affiliate</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-lg text-center p-4">
                <h2 class="text-primary fw-bold">${{ number_format($user->affiliate_earnings ?? 0, 2) }}</h2>
                <p class="text-muted">Total Earnings</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-lg text-center p-4">
                <h2 class="text-success fw-bold">18%</h2>
                <p class="text-muted">Commission Rate</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-lg text-center p-4">
                <h2 class="text-info fw-bold">{{ $user->referral_code }}</h2>
                <p class="text-muted">Your Referral Code</p>
            </div>
        </div>
    </div>

    <div class="mt-5 p-4 bg-light rounded border">
        <h5>Your Personal Referral Link:</h5>
        <code class="bg-white p-3 rounded d-block fs-5">
            https://yourdomain.com/signup?{{ $user->referral_code }}
        </code>
        <button onclick="navigator.clipboard.writeText('https://yourdomain.com/signup?{{ $user->referral_code }}')"
                class="btn btn-primary mt-3">Copy Link</button>
    </div>

    <div class="text-center mt-4">
        <form action="{{ route('affiliate.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Logout</button>
        </form>
    </div>
</div>
@endsection
