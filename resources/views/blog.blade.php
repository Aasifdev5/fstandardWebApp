{{-- resources/views/blog.blade.php --}}
@extends('master')

@section('title', 'Trading Insights & News')

@section('content')
@php
    function calculateReadTime($content) {
        $wordCount = str_word_count(strip_tags($content ?? ''));
        return max(1, ceil($wordCount / 200));
    }
@endphp

<style>
    :root {
        --primary: #f89c10;
        --primary-dark: #e07a00;
        --accent: #f89c10;
        --gradient: linear-gradient(135deg, #f89c10 0%, #ff9f1c 100%);
        --light-bg: #fff8e1;
    }

    .section-title {
        position: relative;
        padding-bottom: 15px;
        color: #333;
        font-weight: 800;
    }
    .section-title:after {
        tipped: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 90px;
        height: 5px;
        background: var(--gradient);
        border-radius: 3px;
    }

    .blog-card {
        background: white;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .blog-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 25px 50px rgba(248, 156, 16, 0.2);
    }

    .blog-card-img {
        height: 240px;
        overflow: hidden;
    }
    .blog-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .blog-card:hover .blog-card-img img {
        transform: scale(1.1);
    }

    .blog-card-body {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .blog-meta {
        font-size: 0.95rem;
        color: #777;
        margin-bottom: 14px;
        font-weight: 500;
    }
    .blog-meta i {
        color: var(--primary);
    }

    .blog-card h4 {
        font-weight: 800;
        color: #222;
        line-height: 1.3;
        margin-bottom: 12px;
    }

    .btn-primary {
        background: var(--gradient);
        border: none;
        border-radius: 50px;
        padding: 11px 30px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(248, 156, 16, 0.3);
    }
    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(248, 156, 16, 0.4);
    }

    .input-group .form-control {
        border-radius: 50px 0 0 50px;
        padding: 14px 20px;
        font-size: 1.1rem;
    }
    .input-group .btn {
        border-radius: 0 50px 50px 0;
        padding: 14px 30px;
    }

    .pagination .page-link {
        border-radius: 50%;
        margin: 0 5px;
        color: var(--primary);
        border: 2px solid var(--primary);
    }
    .pagination .page-item.active .page-link {
        background: var(--gradient);
        border-color: var(--primary);
        color: white;
    }
</style>

<section class="py-5" style="background: linear-gradient(135deg, #fff8e1 0%, #fff 50%);">
    <div class="container">
        <h1 class="text-center display-5 fw-bold mb-3 section-title">Trading Insights & News</h1>
        <p class="text-center lead text-muted mb-5">Stay ahead with expert analysis, strategies, and market updates</p>

        <!-- Search Bar -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7">
                <form action="{{ url('blog') }}" method="GET">
                    <div class="input-group shadow-lg">
                        <input type="text" name="query" class="form-control form-control-lg border-0"
                               placeholder="Search articles..." value="{{ request('query') }}">
                        <button class="btn btn-primary btn-lg" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-4">
            @forelse($blogs as $blog)
                @php
                    $readTime = calculateReadTime($blog->details ?? $blog->short_description);
                @endphp

                <div class="col-lg-4 col-md-6">
                    <article class="blog-card">
                        <div class="blog-card-img">
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
                        </div>
                        <div class="blog-card-body">
                            <div class="blog-meta">
                                <i class="fas fa-calendar-alt me-2"></i>{{ $blog->created_at->format('M d, Y') }}
                                <span class="ms-3"><i class="fas fa-clock me-1"></i> {{ $readTime }} min read</span>
                            </div>

                            <h4 class="fw-bold mt-2">{{ $blog->title }}</h4>
                            <p class="text-muted flex-grow-1">
                                {!! Str::limit(strip_tags($blog->short_description), 130) !!}
                            </p>

                            <a href="{{ url('blog_detail/' . $blog->slug) }}" class="btn btn-primary btn-sm align-self-start mt-3">
                                Read More <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="bg-white rounded-4 shadow p-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <p class="lead text-muted">No articles found matching "<strong>{{ request('query') }}</strong>"</p>
                        <a href="{{ url('blog') }}" class="btn btn-primary mt-3">View All Articles</a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($blogs->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $blogs->appends(request()->query())->links() }}
            </div>
        @endif

        <!-- All Articles Button -->
        <div class="text-center mt-5">
            <a href="{{ url('blog') }}" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-book-open me-2"></i> View All Articles
            </a>
        </div>
    </div>
</section>
@endsection
