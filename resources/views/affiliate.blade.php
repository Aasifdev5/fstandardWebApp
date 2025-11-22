@extends('master')

@section('title')
    {{ __('Become Affiliate') }}
@endsection

@section('content')
<section class="py-5 bg-light">
      <div class="container">
        <h1 class="text-center display-5 fw-bold mb-5 section-title">Become an F Standard Affiliate</h1>
        <p class="text-center lead mb-5">Share, Get Paid, Repeat. Earn Like An Infinite Star!</p>

        <div class="row mb-5">
          <div class="col-md-8 mx-auto text-center">
            <h3 class="fw-bold mb-4">Start earning up to 18% commission on every referral.</h3>
            <div class="d-flex justify-content-center gap-3 mt-4">
              <a href="#" class="btn btn-primary btn-lg">Become an Affiliate</a>
              <a href="#" class="btn btn-outline-primary btn-lg">Affiliate Login</a>
            </div>
          </div>
        </div>

        <div class="row mb-5">
          <div class="col-12">
            <div class="globe-bg">
              <h3 class="fw-bold mb-4">Join Our Global Affiliate Network</h3>
              <div class="row mt-5">
                <div class="col-md-3 mb-4">
                  <div class="stats-number">18,000+</div>
                  <h4 class="h5">Active Affiliates</h4>
                </div>
                <div class="col-md-3 mb-4">
                  <div class="stats-number">Bi-weekly</div>
                  <h4 class="h5">Payout Time</h4>
                  <p class="mb-0">Mondays and Wednesdays</p>
                </div>
                <div class="col-md-3 mb-4">
                  <div class="stats-number">$3M+</div>
                  <h4 class="h5">Paid to Affiliates</h4>
                </div>
                <div class="col-md-3 mb-4">
                  <div class="stats-number">20+</div>
                  <h4 class="h5">Events Per Year</h4>
                  <p class="mb-0">For Affiliates</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
