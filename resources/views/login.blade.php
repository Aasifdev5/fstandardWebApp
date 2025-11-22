@extends('master')

@section('title')
    {{ __('Sign In') }}
@endsection

@section('content')

<section class="auth-container">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-7">
            <div class="auth-card">
              <div class="auth-header">
                <h3 class="fw-bold mb-0">Sign In Your Account</h3>
                <p class="mb-0">Join thousands of successful traders with F Standard</p>
              </div>
              <div class="auth-body">
                <form id="signup-form">

                  <div class="mb-3">
                    <label for="signupEmail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="signupEmail" required>
                  </div>
                  <div class="mb-3">
                    <label for="signupPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="signupPassword" required>
                  </div>

                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                    <label class="form-check-label" for="agreeTerms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 btn-lg">Create Account</button>
                  <hr class="my-4">
                  <p class="text-center mb-0">Don't have an account? <a href="{{ url('signup') }}" class="fw-bold" >Sign Up here</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection
