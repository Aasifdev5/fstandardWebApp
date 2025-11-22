@extends('master')
@section('title')
{{ __('FAQ') }}
@endsection
@section('content')
<section class="py-5 bg-light">
      <div class="container">
        <h1 class="text-center display-5 fw-bold mb-5 section-title">Frequently Asked Questions</h1>
        <p class="text-center lead mb-5">Find answers to common questions about our funding programs and platform</p>

        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="faq-card">
              <div class="faq-header">
                <h5 class="mb-0 fw-bold">What is the F Standard evaluation process?</h5>
              </div>
              <div class="faq-body">
                <p class="mb-0">The F Standard evaluation process consists of two phases. In Phase 1, you need to reach an 8% profit target without violating our trading rules. In Phase 2, you need to achieve a 5% profit target while continuing to adhere to our risk management rules. Once both phases are completed, you'll receive a funded account.</p>
              </div>
            </div>

            <div class="faq-card">
              <div class="faq-header">
                <h5 class="mb-0 fw-bold">How long does the payout process take?</h5>
              </div>
              <div class="faq-body">
                <p class="mb-0">We process payouts within 24 hours of request. In fact, our average payout time is just 5 hours. If we exceed 24 hours, you'll receive a $1,000 compensation as part of our guaranteed payout promise.</p>
              </div>
            </div>

            <div class="faq-card">
              <div class="faq-header">
                <h5 class="mb-0 fw-bold">Are there any time limits for completing the challenge?</h5>
              </div>
              <div class="faq-body">
                <p class="mb-0">No, there are no time limits for completing either phase of our evaluation process. You can take as long as you need to reach your profit targets, allowing you to trade at your own pace without pressure.</p>
              </div>
            </div>

            <div class="text-center mt-5">
              <p class="lead">Still have questions? We're here to help!</p>
              <a href="#" class="btn btn-primary btn-lg" data-page="contact">Contact Support</a>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
