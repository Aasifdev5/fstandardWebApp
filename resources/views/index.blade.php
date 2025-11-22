@extends('master')
@section('title')
{{ __('Home') }}
@endsection
@section('content')
<!-- HERO SECTION -->
  <section class="hero-section page-content active" id="home">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <h1 class="hero-title">
            Trade Our Capital.<br>
            <span>Keep Your Profits.</span>
          </h1>

          <p class="hero-text">
            FStandard is India's first institutional-grade dual-asset proprietary trading firm,
            empowering disciplined traders with the capital they need to succeed.
          </p>

          <div class="mt-4">
            <button class="btn-orange me-3">Start Evaluation</button>
            <button class="btn-outline-orange">View Rules</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FEATURES -->
  <section class="page-content active" id="home-features" style="background:#f8f8f8; padding:70px 0;">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-3 col-sm-6">
          <div class="feature-box">
            <div class="feature-title">6% Trailing Drawdown</div>
            <div class="feature-text">Your safety net for consistent growth.</div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="feature-box">
            <div class="feature-title">70% Profit Share</div>
            <div class="feature-text">You keep the majority of your earnings.</div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="feature-box">
            <div class="feature-title">Dual-Asset Coverage</div>
            <div class="feature-text">Trade FX, Crypto, and Indices.</div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="feature-box">
            <div class="feature-title">20-Day Payouts</div>
            <div class="feature-text">Regular access to your profits.</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- JOURNEY TO FUNDING SECTION -->
  <section class="py-5 page-content active" id="home-journey" style="background:white; padding-top:90px !important;">
    <div class="container text-center">
      <h2 style="font-size:42px; font-weight:700; font-family:Georgia;">
        Your Journey to Funding
      </h2>

      <p class="mt-2" style="font-size:16px; color:#555;">
        A simple, transparent, and fair process designed for serious traders.
      </p>

      <div class="row mt-5 pt-3 justify-content-center">
        <!-- Step 1 -->
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="rounded-circle mx-auto mb-3"
               style="width:55px; height:55px; background:#f89c10; color:white;
                      display:flex; align-items:center; justify-content:center;
                      font-weight:700; font-size:20px;">
            1
          </div>
          <h5 style="font-weight:700;">Choose Your Evaluation</h5>
          <p style="font-size:14px; color:#555;">
            Select a plan that matches your trading style and capital goals. Start your
            journey with a clear path.
          </p>
        </div>

        <!-- Step 2 -->
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="rounded-circle mx-auto mb-3"
               style="width:55px; height:55px; background:#f89c10; color:white;
                      display:flex; align-items:center; justify-content:center;
                      font-weight:700; font-size:20px;">
            2
          </div>
          <h5 style="font-weight:700;">Trade with Discipline</h5>
          <p style="font-size:14px; color:#555;">
            Meet the profit targets while respecting our straightforward risk
            management rules. Consistency is key.
          </p>
        </div>

        <!-- Step 3 -->
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="rounded-circle mx-auto mb-3"
               style="width:55px; height:55px; background:#f89c10; color:white;
                      display:flex; align-items:center; justify-content:center;
                      font-weight:700; font-size:20px;">
            3
          </div>
          <h5 style="font-weight:700;">Get Funded & Withdraw</h5>
          <p style="font-size:14px; color:#555;">
            Successfully pass the evaluation to trade our capital. Withdraw your 70%
            profit share every 20 trading days.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- FUNDING PLANS SECTION -->
  <section class="py-5 page-content active" id="home-plans" style="background:#f3f3f3;">
    <div class="container">
      <h2 class="text-center mb-5 section-title">Funding Plans</h2>
      <div class="row gy-4 justify-content-center">
        <!-- 20L CARD -->
        <div class="col-lg-3 col-md-6">
          <div class="fund-card active">
            <div class="fund-big-bg">20L</div>
            <h2 style="font-weight:700;">20L</h2>
            <div class="line"></div>
            <p style="font-style:italic; margin-top:-5px;">Funding</p>
            <p style="font-size:13px; letter-spacing:1px; font-weight:600;">CAPITAL: ₹20,00,000</p>
            <hr>
            <h3 style="font-weight:700;">₹37,000</h3>
            <small>One-time assessment fee</small>
            <div class="fund-list mt-4">
              <p><strong>Profit Target</strong> <span class="float-end">8%</span></p>
              <p><strong>Max Loss</strong> <span class="float-end">6%</span></p>
              <p><strong>Drawdown Type</strong> <span class="float-end">Trailing</span></p>
              <p><strong>Payout Cycle</strong> <span class="float-end">20 Days</span></p>
              <p><strong>News Trading</strong> <span class="float-end">Allowed</span></p>
              <p><strong>Weekend Holding</strong> <span class="float-end">Allowed</span></p>
            </div>
            <button class="btn-orange mt-3">Start Evaluation</button>
          </div>
        </div>

        <!-- 50L CARD -->
        <div class="col-lg-3 col-md-6">
          <div class="fund-card">
            <div class="fund-big-bg">50L</div>
            <h2 style="font-weight:700;">50L</h2>
            <div class="line"></div>
            <p style="font-style:italic; margin-top:-5px;">Funding</p>
            <p style="font-size:13px; letter-spacing:1px; font-weight:600;">CAPITAL: ₹50,00,000</p>
            <hr>
            <h3 style="font-weight:700;">₹55,000</h3>
            <small>One-time assessment fee</small>
            <div class="fund-list mt-4">
              <p><strong>Profit Target</strong> <span class="float-end">8%</span></p>
              <p><strong>Max Loss</strong> <span class="float-end">6%</span></p>
              <p><strong>Drawdown Type</strong> <span class="float-end">Trailing</span></p>
              <p><strong>Payout Cycle</strong> <span class="float-end">20 Days</span></p>
              <p><strong>News Trading</strong> <span class="float-end">Allowed</span></p>
              <p><strong>Weekend Holding</strong> <span class="float-end">Allowed</span></p>
            </div>
            <button class="btn-black mt-3">Start Evaluation</button>
          </div>
        </div>

        <!-- 75L CARD -->
        <div class="col-lg-3 col-md-6">
          <div class="fund-card">
            <div class="fund-big-bg">75L</div>
            <h2 style="font-weight:700;">75L</h2>
            <div class="line"></div>
            <p style="font-style:italic; margin-top:-5px;">Funding</p>
            <p style="font-size:13px; letter-spacing:1px; font-weight:600;">CAPITAL: ₹75,00,000</p>
            <hr>
            <h3 style="font-weight:700;">₹77,000</h3>
            <small>One-time assessment fee</small>
            <div class="fund-list mt-4">
              <p><strong>Profit Target</strong> <span class="float-end">8%</span></p>
              <p><strong>Max Loss</strong> <span class="float-end">6%</span></p>
              <p><strong>Drawdown Type</strong> <span class="float-end">Trailing</span></p>
              <p><strong>Payout Cycle</strong> <span class="float-end">20 Days</span></p>
              <p><strong>News Trading</strong> <span class="float-end">Allowed</span></p>
              <p><strong>Weekend Holding</strong> <span class="float-end">Allowed</span></p>
            </div>
            <button class="btn-black mt-3">Start Evaluation</button>
          </div>
        </div>

        <!-- 1Cr CARD -->
        <div class="col-lg-3 col-md-6">
          <div class="fund-card">
            <div class="fund-big-bg">1Cr</div>
            <h2 style="font-weight:700;">1Cr</h2>
            <div class="line"></div>
            <p style="font-style:italic; margin-top:-5px;">Funding</p>
            <p style="font-size:13px; letter-spacing:1px; font-weight:600;">CAPITAL: ₹1,00,00,000</p>
            <hr>
            <h3 style="font-weight:700;">₹1,00,000</h3>
            <small>One-time assessment fee</small>
            <div class="fund-list mt-4">
              <p><strong>Profit Target</strong> <span class="float-end">8%</span></p>
              <p><strong>Max Loss</strong> <span class="float-end">6%</span></p>
              <p><strong>Drawdown Type</strong> <span class="float-end">Trailing</span></p>
              <p><strong>Payout Cycle</strong> <span class="float-end">20 Days</span></p>
              <p><strong>News Trading</strong> <span class="float-end">Allowed</span></p>
              <p><strong>Weekend Holding</strong> <span class="float-end">Allowed</span></p>
            </div>
            <button class="btn-black mt-3">Start Evaluation</button>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- ============================
     Trading Panel + App Download Section
     ============================ -->
<section style="background:#0D0D24; padding:70px 0;">
  <div class="container">

    <!-- Title -->
    <h2 class="text-center"
        style="color:white; font-size:40px; font-weight:700; margin-bottom:10px;">
      Start Trading With F Standard
    </h2>

    <p class="text-center mb-5"
       style="color:#b9c0d4; max-width:650px; margin:auto; font-size:17px;">
      Access your trading dashboard, manage your accounts, and download the F Standard app for seamless trading.
    </p>

    <div class="row justify-content-center text-center">

      <!-- Trading Panel Button -->
      <div class="col-md-4 mb-4">
        <a href="market.html"
           style="
             display:inline-block;
             background:#4C6FFF;
             padding:15px 35px;
             border-radius:40px;
             color:white;
             font-size:18px;
             font-weight:600;
             text-decoration:none;
             box-shadow:0 6px 20px rgba(76,111,255,0.4);
             transition:0.3s;">
          🚀 Open Trading Panel
        </a>
      </div>

      <!-- Android Download -->
      <div class="col-md-3 mb-3">
        <a href="#"
           style="
             display:flex;
             align-items:center;
             justify-content:center;
             gap:12px;
             background:#1A1A32;
             padding:14px 25px;
             border-radius:50px;
             color:white;
             text-decoration:none;
             border:1px solid #2c2c4b;
             font-weight:500;
             transition:0.3s;">
          <img src="https://cdn-icons-png.flaticon.com/512/888/888857.png"
               style="width:26px;">
          <span style="font-size:16px;">Download for Android</span>
        </a>
      </div>

      <!-- iOS Download -->
      <div class="col-md-3 mb-3">
        <a href="#"
           style="
             display:flex;
             align-items:center;
             justify-content:center;
             gap:12px;
             background:#1A1A32;
             padding:14px 25px;
             border-radius:50px;
             color:white;
             text-decoration:none;
             border:1px solid #2c2c4b;
             font-weight:500;
             transition:0.3s;">
          <img src="https://cdn-icons-png.flaticon.com/512/179/179309.png"
               style="width:26px;">
          <span style="font-size:16px;">Download for iOS</span>
        </a>
      </div>

    </div>
  </div>
</section>

  <!-- Testimonials -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-5 section-title">What Our Traders Say</h2>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Trader" class="testimonial-avatar">
                        <h5 class="text-center fw-bold">Michael T.</h5>
                        <p class="text-muted text-center">Professional Forex Trader</p>
                        <div class="text-warning text-center mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-center">"F Standard has completely transformed my trading career. The platform is intuitive, and the support team is always available when I need help."</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Trader" class="testimonial-avatar">
                        <h5 class="text-center fw-bold">Sarah L.</h5>
                        <p class="text-muted text-center">Swing Trader</p>
                        <div class="text-warning text-center mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-center">"The no time limit feature allowed me to trade at my own pace. I reached my profit target without pressure and got funded within a week!"</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <img src="https://randomuser.me/api/portraits/men/76.jpg" alt="Trader" class="testimonial-avatar">
                        <h5 class="text-center fw-bold">David K.</h5>
                        <p class="text-muted text-center">Day Trader</p>
                        <div class="text-warning text-center mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-center">"The payout process is incredibly fast. I received my first profit share in just 4 hours. Highly recommend F Standard to serious traders."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- F Standard - Icons Section -->
<section class="py-5" style="background:#0f0b28; color:white;">
  <div class="container">
    <div class="row align-items-center">

      <!-- LEFT TEXT -->
      <div class="col-lg-4 mb-5">
        <span class="px-3 py-1 rounded-pill" style="background:linear-gradient(45deg,#7b3fe4,#32e6e2); font-size:14px;">
          Stars Talk
        </span>

        <h1 class="mt-4 fw-bold" style="font-size:55px; line-height:1.1;">
          Icons<br> Around<br> the World
        </h1>

        <p class="mt-4" style="font-size:18px; opacity:.8;">
          Global leaders are cheering for and supporting
          <strong>F Standard</strong>. Be part of the best trading journey.
        </p>
      </div>

      <!-- VIDEO CARDS -->
      <div class="col-lg-8">
        <div class="row g-4">

          <!-- CARD 1 -->
          <div class="col-md-4">
            <div class="card border-0 rounded-4" style="background:#1c153e;">
              <div class="position-relative">
                <img src="colin.png"
                     class="card-img-top rounded-4" alt="Image 1">

                <!-- Play Button -->
                <button class="btn play-btn position-absolute top-50 start-50 translate-middle rounded-circle"
                        data-bs-toggle="modal" data-bs-target="#videoModal"
                        data-video="https://www.youtube.com/embed/ScMzIvxBSi4">
                  <i class="fa-solid fa-play text-white"></i>
                </button>
              </div>

              <div class="card-body text-white">
                <p class="fw-semibold" style="font-size:18px;">“Passion takes you to glory.”</p>
                <p class="text-white-50 mb-0">Emi Martinez, <span class="fw-light">Footballer</span></p>
              </div>
            </div>
          </div>

          <!-- CARD 2 -->
          <div class="col-md-4">
            <div class="card border-0 rounded-4" style="background:#1c153e;">
              <div class="position-relative">
                <img src="christ_gayle.png"
                     class="card-img-top rounded-4" alt="Image 2">

                <button class="btn play-btn position-absolute top-50 start-50 translate-middle rounded-circle"
                        data-bs-toggle="modal" data-bs-target="#videoModal"
                        data-video="https://www.youtube.com/embed/tgbNymZ7vqY">
                  <i class="fa-solid fa-play text-white"></i>
                </button>
              </div>

              <div class="card-body text-white">
                <p class="fw-semibold" style="font-size:18px;">“Never give up. Keep moving forward.”</p>
                <p class="text-white-50 mb-0">Chris Gayle, <span class="fw-light">Cricketer</span></p>
              </div>
            </div>
          </div>

          <!-- CARD 3 -->
          <div class="col-md-4">
            <div class="card border-0 rounded-4" style="background:#1c153e;">
              <div class="position-relative">
                <img src="martinez.png"
                     class="card-img-top rounded-4" alt="Image 3">

                <button class="btn play-btn position-absolute top-50 start-50 translate-middle rounded-circle"
                        data-bs-toggle="modal" data-bs-target="#videoModal"
                        data-video="https://www.youtube.com/embed/sVPYIRF9RCQ">
                  <i class="fa-solid fa-play text-white"></i>
                </button>
              </div>

              <div class="card-body text-white">
                <p class="fw-semibold" style="font-size:18px;">“Aim BIG, achieve BIG!”</p>
                <p class="text-white-50 mb-0">Colin Munro, <span class="fw-light">Cricketer</span></p>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
<style>
    .play-btn {
  background:#00aefc;
  width:70px;
  height:70px;
  font-size:22px;
}
.play-btn:hover {
  background:#0088c9;
}
</style>
<!-- VIDEO MODAL -->
<div class="modal fade" id="videoModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark p-0">
      <div class="ratio ratio-16x9">
        <iframe id="videoFrame" src="" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>
<script>
var videoModal = document.getElementById('videoModal');
var videoFrame = document.getElementById('videoFrame');

videoModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget;
  var videoURL = button.getAttribute('data-video') + "?autoplay=1";
  videoFrame.src = videoURL;
});

videoModal.addEventListener('hidden.bs.modal', function () {
  videoFrame.src = "";
});
</script>
<section style="background:#0D0D24; padding:60px 0;">
  <div class="container">

    <!-- Small Top Badge -->
    <div class="text-center mb-3">
      <span style="
        color:#89A9FF;
        border:1px solid #3D4F91;
        padding:6px 16px;
        border-radius:20px;
        font-size:14px;">
        Trader Feedback & Analysis
      </span>
    </div>

    <!-- Title -->
    <h2 class="text-center"
        style="color:white; font-size:44px; font-weight:700; margin-bottom:10px;">
        Our Traders Love Us
    </h2>

    <!-- Subtitle -->
    <p class="text-center mx-auto"
       style="color:#b9c0d4; max-width:650px; font-size:17px;">
      F Standard shines with traders like you! See what real traders say about our
      best-in-class prop trading ecosystem.
    </p>

    <!-- Rating Block -->
    <div class="text-center mt-3 mb-5">
      <h4 style="color:white; font-size:24px; font-weight:600; margin-bottom:6px;">
        Excellent
        <img src="https://via.placeholder.com/80x20/00b67a/ffffff?text=★★★★★"
             style="height:22px; margin-left:4px;">
      </h4>

      <div style="color:#7e8aa6; font-size:15px;">
        Rated 4.9 / 5 based on <u>12,482 reviews</u> on
        <span style="color:#00b67a; font-weight:600;">★ Trustpilot</span>
      </div>
    </div>

    <!-- Reviews Grid -->
    <div class="row g-4">

      <!-- Review Card -->
      <div class="col-md-4">
        <div style="background:white; border-radius:12px; padding:20px;">
          <img src="https://via.placeholder.com/120x24/f5f5f5/00b67a?text=★★★★☆"
               style="height:24px; margin-bottom:10px;">
          <div style="font-size:14px; color:#6b6f76; margin-bottom:6px;">
            Amaan R • 20 minutes ago
          </div>
          <h6 style="font-weight:700;">Super Fast Support!</h6>
          <p style="margin:0;">Amazing trading platform & instant response team.</p>
        </div>
      </div>

      <!-- Review Card -->
      <div class="col-md-4">
        <div style="background:white; border-radius:12px; padding:20px;">
          <img src="https://via.placeholder.com/120x24/f5f5f5/00b67a?text=★★★★★"
               style="height:24px; margin-bottom:10px;">
          <div style="font-size:14px; color:#6b6f76; margin-bottom:6px;">
            Dhruv S • 1 hour ago
          </div>
          <h6 style="font-weight:700;">One of the Best Prop Firms</h6>
          <p style="margin:0;">Rules are clean, payouts are on time. Love this firm!</p>
        </div>
      </div>

      <!-- Review Card -->
      <div class="col-md-4">
        <div style="background:white; border-radius:12px; padding:20px;">
          <img src="https://via.placeholder.com/120x24/f5f5f5/00b67a?text=★★★☆☆"
               style="height:24px; margin-bottom:10px;">
          <div style="font-size:14px; color:#6b6f76; margin-bottom:6px;">
            Priya K • 2 hours ago
          </div>
          <h6 style="font-weight:700;">Great Community</h6>
          <p style="margin:0;">Learnt so much from F Standard’s trader community.</p>
        </div>
      </div>

      <!-- More Cards -->
      <div class="col-md-4">
        <div style="background:white; border-radius:12px; padding:20px;">
          <img src="https://via.placeholder.com/120x24/f5f5f5/00b67a?text=★★★★★"
               style="height:24px; margin-bottom:10px;">
          <div style="font-size:14px; color:#6b6f76; margin-bottom:6px;">
            Zaid M • 3 hours ago
          </div>
          <h6 style="font-weight:700;">Fantastic Services</h6>
          <p style="margin:0;">My best trading experience so far.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div style="background:white; border-radius:12px; padding:20px;">
          <img src="https://via.placeholder.com/120x24/f5f5f5/00b67a?text=★★★★★"
               style="height:24px; margin-bottom:10px;">
          <div style="font-size:14px; color:#6b6f76; margin-bottom:6px;">
            Mehul P • 4 hours ago
          </div>
          <h6 style="font-weight:700;">Very Helpful Team</h6>
          <p style="margin:0;">They helped me fix account issues instantly.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div style="background:white; border-radius:12px; padding:20px;">
          <img src="https://via.placeholder.com/120x24/f5f5f5/00b67a?text=★★★★☆"
               style="height:24px; margin-bottom:10px;">
          <div style="font-size:14px; color:#6b6f76; margin-bottom:6px;">
            Surya T • 5 hours ago
          </div>
          <h6 style="font-weight:700;">Best for Beginners</h6>
          <p style="margin:0;">I'm learning fast thanks to their guidance.</p>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection
