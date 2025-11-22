@extends('master')

@section('title', __('Panel'))

@section('content')
<div class="page_content_wrap" style="padding-top: 0 !important; padding-bottom: 0 !important;">
  <div class="content_wrap">
    <section class="py-5 bg-dark">
      <div class="container" style="margin-top: 50px">
        @if(Session::has('success'))
        <div class="alert alert-success">
          <p>{{ session::get('success') }}</p>
        </div>
        @endif
        @if(Session::has('fail'))
        <div class="alert alert-danger">
          <p>{{ session::get('fail') }}</p>
        </div>
        @endif
        <h1 class="text-light mb-4">{{ __('Panel') }}</h1>

        <div class="elementor-row">
          <!-- Side Menu -->
          <div class="elementor-column elementor-col-25">
            <div class="text-white p-3 rounded">
                <div class="menu-item mb-3 d-flex align-items-center">
                  <a href="{{ url('dashboard') }}" style="text-decoration: none; color: inherit;">
                    <i class="fa-solid fa-gauge me-2"></i> <!-- Dashboard Icon -->
                    <span>{{ __('Panel') }}</span>
                  </a>
                </div>
                <div class="menu-item mb-3 d-flex align-items-center">
                  <a href="{{ url('news') }}" style="text-decoration: none; color: inherit;">
                    <i class="fa-solid fa-newspaper me-2"></i> <!-- News Icon -->
                    <span>{{ __('Nuevas Noticias') }}</span>
                  </a>
                </div>
                <div class="menu-item d-flex align-items-center">
                  <a href="{{ url('logout') }}" style="text-decoration: none; color: inherit;">
                    <i class="fa-solid fa-right-from-bracket me-2"></i> <!-- Logout Icon -->
                    <span>{{ __('Logout') }}</span>
                  </a>
                </div>
              </div>

          </div>

          <!-- Main Content -->
          <div class="elementor-column elementor-col-75">
            <h4 class="text-light mb-3">{{ __('Welcome ') . $user_session->name }}</h4>



          </div>
        </div>

      </div>
    </section>
  </div>
</div>
@endsection
