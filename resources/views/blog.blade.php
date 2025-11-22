@extends('master')

@section('title')
    Blog
@endsection

@section('content')
<!-- Blog Page -->

    <section class="py-5 bg-light">
      <div class="container">
        <h1 class="text-center display-5 fw-bold mb-5 section-title">Trading Insights & News</h1>
        <p class="text-center lead mb-5">Stay updated with the latest market analysis, trading strategies, and platform updates</p>

        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="blog-card">
              <div class="blog-card-body">
                <span class="blog-meta"><i class="fas fa-calendar me-1"></i> October 15, 2023</span>
                <h4 class="fw-bold mt-2">5 Advanced Trading Strategies for Volatile Markets</h4>
                <p class="text-muted">Learn how to navigate high-volatility periods with these proven trading strategies that can help maximize your profits.</p>
                <a href="#" data-page="blog-detail" class="btn btn-primary btn-sm">Read More</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="blog-card">
              <div class="blog-card-body">
                <span class="blog-meta"><i class="fas fa-calendar me-1"></i> October 10, 2023</span>
                <h4 class="fw-bold mt-2">The Complete Guide to Risk Management in Trading</h4>
                <p class="text-muted">Discover essential risk management techniques that every successful trader should implement in their strategy.</p>
                <a href="#" data-page="blog-detail" class="btn btn-primary btn-sm">Read More</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="blog-card">
              <div class="blog-card-body">
                <span class="blog-meta"><i class="fas fa-calendar me-1"></i> October 5, 2023</span>
                <h4 class="fw-bold mt-2">Q4 2023 Market Outlook: Key Trends to Watch</h4>
                <p class="text-muted">Get insights into the major market trends and economic factors that could impact your trading in the coming months.</p>
                <a href="#" data-page="blog-detail" class="btn btn-primary btn-sm">Read More</a>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-5">
          <a href="#" class="btn btn-primary btn-lg">View All Articles</a>
        </div>
      </div>
    </section>



@endsection
