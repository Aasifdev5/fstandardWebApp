@extends('master')

@section('title')
    {{ __('SignUp') }}
@endsection

@section('content')
<section class="auth-container">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-7">
            <div class="auth-card">
              <div class="auth-header">
                <h3 class="fw-bold mb-0">Create Your Account</h3>
                <p class="mb-0">Join thousands of successful traders with F Standard</p>
              </div>
              <div class="auth-body">
                <form id="signup-form">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="signupFirstName" class="form-label">First Name</label>
                      <input type="text" class="form-control" id="signupFirstName" required>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="signupLastName" class="form-label">Last Name</label>
                      <input type="text" class="form-control" id="signupLastName" required>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="signupEmail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="signupEmail" required>
                  </div>
                  <div class="mb-3">
                    <label for="signupPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="signupPassword" required>
                  </div>
                  <div class="mb-3">
                    <label for="signupConfirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="signupConfirmPassword" required>
                  </div>
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                    <label class="form-check-label" for="agreeTerms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 btn-lg">Create Account</button>
                  <hr class="my-4">
                  <p class="text-center mb-0">Already have an account? <a href="{{ url('Userlogin') }}" class="fw-bold" >Sign in here</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
