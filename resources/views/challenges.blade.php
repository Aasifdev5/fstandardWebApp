@extends('master')
@section('title')
    {{ __('Challenges') }}
@endsection
@section('content')
<section class="py-5 bg-light">
      <div class="container">
        <h1 class="text-center display-5 fw-bold mb-5 section-title">Trading Challenges</h1>
        <p class="text-center lead mb-5">Test your skills and get funded with our evaluation programs</p>

        <div class="row">
          <div class="col-md-6 mb-4">
            <div class="card dashboard-card h-100">
              <div class="card-body p-4 text-center">
                <div class="feature-icon mx-auto mb-3">
                  <i class="fas fa-flag"></i>
                </div>
                <h4 class="fw-bold mb-3">Phase 1 Evaluation</h4>
                <p class="text-muted mb-4">Reach an 8% profit target without violating our trading rules. No time limits, trade at your own pace.</p>
                <ul class="list-unstyled text-start mb-4">
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 6% Maximum Loss</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Trailing Drawdown</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i> News Trading Allowed</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Weekend Holding Allowed</li>
                </ul>
                <a href="#" class="btn btn-primary">Start Phase 1</a>
              </div>
            </div>
          </div>

          <div class="col-md-6 mb-4">
            <div class="card dashboard-card h-100">
              <div class="card-body p-4 text-center">
                <div class="feature-icon mx-auto mb-3">
                  <i class="fas fa-trophy"></i>
                </div>
                <h4 class="fw-bold mb-3">Phase 2 Evaluation</h4>
                <p class="text-muted mb-4">Achieve a 5% profit target while continuing to adhere to our risk management rules.</p>
                <ul class="list-unstyled text-start mb-4">
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Same Rules as Phase 1</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Lower Profit Target (5%)</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i> No Time Limits</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Get Funded Upon Completion</li>
                </ul>
                <a href="#" class="btn btn-primary">Start Phase 2</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
