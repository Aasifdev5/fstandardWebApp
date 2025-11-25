@extends('master')

@section('title')
    {{ __('Become F Standard Affiliate') }}
@endsection

@section('styles')
    <style>
        :root {
            --primary: #7c3aed;
            --primary-dark: #6d28d9;
            --primary-light: #8b5cf6;
            --secondary: #f59e0b;
            --accent: #10b981;
            --dark: #1e293b;
            --light: #f8fafc;
            --gradient: linear-gradient(135deg, #7c3aed 0%, #4f46e5 100%);
            --gradient-secondary: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            --gradient-accent: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--light);
            overflow-x: hidden;
        }

        /* Enhanced Hero Section */
        .hero-section {
            background:
                radial-gradient(circle at 20% 80%, rgba(124, 58, 237, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.05) 0%, transparent 50%),
                linear-gradient(135deg, rgba(124, 58, 237, 0.03) 0%, rgba(79, 70, 229, 0.03) 100%);
            position: relative;
            padding: 120px 0 100px;
            overflow: hidden;
        }

        .hero-bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle at 25% 25%, rgba(124, 58, 237, 0.1) 2px, transparent 0),
                radial-gradient(circle at 75% 75%, rgba(245, 158, 11, 0.08) 2px, transparent 0);
            background-size: 50px 50px, 30px 30px;
            background-position: 0 0, 25px 25px;
            opacity: 0.4;
        }

        .hero-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: var(--gradient);
            opacity: 0.08;
            filter: blur(80px);
            top: -300px;
            right: -200px;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 3;
        }

        .display-3 {
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #1e293b 0%, #7c3aed 30%, #f59e0b 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            position: relative;
        }

        .display-3::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--gradient);
            border-radius: 2px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            background: rgba(124, 58, 237, 0.1);
            border: 1px solid rgba(124, 58, 237, 0.2);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
        }

        .hero-badge i {
            margin-right: 8px;
            animation: pulse 2s infinite;
        }

        .lead {
            font-size: 1.3rem;
            font-weight: 400;
            color: #64748b;
            max-width: 700px;
            margin: 0 auto 3rem;
            line-height: 1.7;
        }

        .commission-highlight {
            background: var(--gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 700;
            position: relative;
        }

        .commission-highlight::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--gradient);
            border-radius: 2px;
            opacity: 0.3;
        }

        /* Enhanced Buttons */
        .btn-primary {
            background: var(--gradient);
            border: none;
            padding: 16px 40px;
            font-weight: 700;
            border-radius: 16px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow:
                0 8px 25px rgba(124, 58, 237, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow:
                0 15px 35px rgba(124, 58, 237, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 16px 40px;
            font-weight: 700;
            border-radius: 16px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-outline-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: var(--gradient);
            transition: all 0.4s ease;
            z-index: -1;
        }

        .btn-outline-primary:hover::before {
            width: 100%;
        }

        .btn-outline-primary:hover {
            color: white;
            border-color: transparent;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(124, 58, 237, 0.3);
        }

        /* Enhanced Stats Section */
        .stats-section {
            background: var(--gradient);
            border-radius: 30px;
            padding: 80px 40px;
            color: white;
            position: relative;
            overflow: hidden;
            margin: 100px 0;
            box-shadow:
                0 25px 50px rgba(124, 58, 237, 0.25),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .stats-glow {
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            filter: blur(60px);
            top: -200px;
            right: -100px;
        }

        .stats-grid {
            position: relative;
            z-index: 2;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            position: relative;
        }

        .stat-item::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 1px;
            height: 100%;
            background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.3), transparent);
        }

        .stat-item:last-child::before {
            display: none;
        }

        .stats-number {
            font-size: 4rem;
            font-weight: 900;
            line-height: 1;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #e2e8f0 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .stats-label {
            font-size: 1.2rem;
            font-weight: 600;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }

        .stats-subtext {
            font-size: 0.9rem;
            opacity: 0.7;
        }

        /* Enhanced Benefits Section */
        .benefits-section {
            padding: 100px 0;
            background:
                radial-gradient(circle at 10% 20%, rgba(124, 58, 237, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 90% 80%, rgba(245, 158, 11, 0.03) 0%, transparent 50%);
        }

        .section-title {
            font-weight: 900;
            font-size: 3rem;
            text-align: center;
            margin-bottom: 4rem;
            color: var(--dark);
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 5px;
            background: var(--gradient);
            border-radius: 3px;
        }

        .benefit-card {
            background: white;
            border-radius: 24px;
            padding: 50px 30px;
            text-align: center;
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid #f1f5f9;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .benefit-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .benefit-card:hover::before {
            transform: scaleX(1);
        }

        .benefit-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow:
                0 25px 50px rgba(124, 58, 237, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
        }

        .benefit-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 40px;
            background: var(--gradient);
            color: white;
            box-shadow: 0 10px 25px rgba(124, 58, 237, 0.3);
            transition: all 0.4s ease;
        }

        .benefit-card:hover .benefit-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 15px 30px rgba(124, 58, 237, 0.4);
        }

        .benefit-title {
            font-weight: 800;
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--dark);
        }

        .benefit-text {
            color: #64748b;
            line-height: 1.7;
            font-size: 1.05rem;
        }

        /* Enhanced Testimonials */
        .testimonial-section {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.05) 0%, rgba(217, 119, 6, 0.05) 100%);
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .testimonial-card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            border: 1px solid #f1f5f9;
            height: 100%;
            position: relative;
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12);
        }

        .testimonial-quote {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 60px;
            color: var(--primary);
            opacity: 0.1;
            line-height: 1;
        }

        .testimonial-text {
            font-style: italic;
            color: #475569;
            line-height: 1.8;
            margin-bottom: 30px;
            font-size: 1.1rem;
            position: relative;
            z-index: 2;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
        }

        .author-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            margin-right: 20px;
            box-shadow: 0 5px 15px rgba(124, 58, 237, 0.3);
        }

        .author-info h5 {
            margin: 0;
            font-weight: 700;
            color: var(--dark);
        }

        .author-info p {
            margin: 0;
            color: #64748b;
            font-size: 0.95rem;
        }

        .author-rating {
            color: #f59e0b;
            margin-top: 5px;
        }

        /* Enhanced CTA Section */
        .cta-section {
            background: var(--gradient);
            padding: 100px 0;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.1) 2px, transparent 0),
                radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.1) 2px, transparent 0);
            background-size: 40px 40px, 60px 60px;
            background-position: 0 0, 20px 20px;
        }

        .cta-content {
            position: relative;
            z-index: 3;
        }

        .cta-title {
            font-weight: 900;
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .cta-text {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .btn-light {
            background: white;
            color: var(--primary);
            padding: 18px 45px;
            font-weight: 800;
            border-radius: 16px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.2);
            border: none;
            font-size: 1.1rem;
            position: relative;
            overflow: hidden;
        }

        .btn-light::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(124, 58, 237, 0.1), transparent);
            transition: left 0.5s;
        }

        .btn-light:hover::before {
            left: 100%;
        }

        .btn-light:hover {
            transform: translateY(-5px) scale(1.03);
            box-shadow: 0 20px 40px rgba(255, 255, 255, 0.3);
        }

        /* Enhanced Modals */
        .modal-content {
            border-radius: 24px;
            border: none;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            background: white;
        }

        .modal-header {
            border-bottom: 1px solid #f1f5f9;
            padding: 30px 40px 20px;
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
        }

        .modal-title {
            font-weight: 800;
            font-size: 1.8rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .modal-body {
            padding: 30px 40px 40px;
        }

        .form-control-modern {
            border-radius: 12px;
            padding: 16px 20px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
            font-size: 1rem;
            background: #f8fafc;
        }

        .form-control-modern:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.15);
            background: white;
        }

        /* Floating Elements */
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            overflow: hidden;
        }

        .floating-element {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            background: var(--primary);
            animation: float 20s infinite ease-in-out;
        }

        .floating-element:nth-child(1) {
            width: 120px;
            height: 120px;
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 80px;
            height: 80px;
            top: 70%;
            right: 10%;
            animation-delay: 5s;
            background: var(--secondary);
        }

        .floating-element:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 15%;
            animation-delay: 10s;
            background: var(--accent);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg) scale(1);
            }

            33% {
                transform: translateY(-30px) rotate(120deg) scale(1.1);
            }

            66% {
                transform: translateY(15px) rotate(240deg) scale(0.9);
            }
        }

        /* Enhanced Animations */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(124, 58, 237, 0.4);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(124, 58, 237, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(124, 58, 237, 0);
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .display-3 {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2.2rem;
            }

            .cta-title {
                font-size: 2.5rem;
            }

            .stats-number {
                font-size: 3rem;
            }

            .stat-item::before {
                display: none;
            }

            .hero-badge {
                font-size: 0.8rem;
                padding: 6px 12px;
            }
        }

        /* Scroll Animations */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Progress Bar */
        .progress-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: transparent;
            z-index: 1000;
        }

        .progress-bar {
            height: 4px;
            background: var(--gradient);
            width: 0%;
            transition: width 0.3s ease;
        }
    </style>
@endsection

@section('content')
    <!-- Progress Bar -->
    <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-bg-pattern"></div>
        <div class="hero-glow"></div>
        <div class="floating-elements">
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center hero-content">
                    <div class="hero-badge">
                        <i class="fas fa-crown"></i>
                        TOP-TIER AFFILIATE PROGRAM
                    </div>

                    <h1 class="display-3 fw-bold mb-4">
                        Transform Your Influence<br>Into <span class="gradient-text">Passive Income</span>
                    </h1>

                    <p class="lead">
                        Join <strong class="commission-highlight">18,000+ successful affiliates</strong> earning up to
                        <strong class="commission-highlight">18% lifetime commissions</strong> with our premium affiliate
                        program.
                        No experience required - we provide everything you need to succeed.
                    </p>

                    <div class="d-flex flex-column flex-md-row gap-4 justify-content-center mb-5">
                        <button type="button" class="btn btn-primary btn-lg px-5 py-3 fw-bold pulse" data-bs-toggle="modal"
                            data-bs-target="#registerModal">
                            <i class="fas fa-rocket me-2"></i> Launch Your Earnings
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-lg px-5 py-3 fw-bold"
                            data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="fas fa-sign-in-alt me-2"></i> Affiliate Portal
                        </button>
                    </div>

                    <div class="row justify-content-center mt-5">
                        <div class="col-md-10">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-bolt text-primary me-3 fs-4"></i>
                                        <div class="text-start">
                                            <h5 class="mb-1 fw-bold">Instant Access</h5>
                                            <p class="mb-0 text-muted">Start in minutes</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-gem text-primary me-3 fs-4"></i>
                                        <div class="text-start">
                                            <h5 class="mb-1 fw-bold">Premium Resources</h5>
                                            <p class="mb-0 text-muted">All tools included</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-shield-alt text-primary me-3 fs-4"></i>
                                        <div class="text-start">
                                            <h5 class="mb-1 fw-bold">Lifetime Commissions</h5>
                                            <p class="mb-0 text-muted">Earn forever</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="container">
        <div class="stats-section">
            <div class="stats-glow"></div>
            <div class="stats-grid">
                <div class="row text-center">
                    <div class="col-md-3 mb-5 mb-md-0">
                        <div class="stat-item">
                            <div class="stats-number" data-count="18000">18,000+</div>
                            <div class="stats-label">Elite Affiliates</div>
                            <div class="stats-subtext">Growing Daily</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-5 mb-md-0">
                        <div class="stat-item">
                            <div class="stats-number">Bi-weekly</div>
                            <div class="stats-label">Fast Payouts</div>
                            <div class="stats-subtext">Every Monday & Wednesday</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-5 mb-md-0">
                        <div class="stat-item">
                            <div class="stats-number" data-count="3">$3M+</div>
                            <div class="stats-label">Commission Paid</div>
                            <div class="stats-subtext">And Counting</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item">
                            <div class="stats-number" data-count="20">20+</div>
                            <div class="stats-label">VIP Events</div>
                            <div class="stats-subtext">Masterminds & Retreats</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section" style="margin-top: 100px;">
        <div class="container">
            <h2 class="section-title fade-in-up">Why You'll <span>Love It Here</span></h2>

            <div class="row g-5">
                <div class="col-md-4">
                    <div class="benefit-card fade-in-up">
                        <div class="benefit-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="benefit-title">Maximum Earnings</h3>
                        <p class="benefit-text">Our tiered commission structure rewards performance. Top affiliates earn up
                            to 25% on premium products with no caps or limits.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="benefit-card fade-in-up">
                        <div class="benefit-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3 class="benefit-title">Advanced Tools</h3>
                        <p class="benefit-text">Access our suite of marketing tools: smart links, automated tracking,
                            conversion optimization, and AI-powered recommendations.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="benefit-card fade-in-up">
                        <div class="benefit-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="benefit-title">Elite Community</h3>
                        <p class="benefit-text">Join our private mastermind with 18,000+ affiliates. Network, share
                            strategies, and get mentorship from top earners.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="benefit-card fade-in-up">
                        <div class="benefit-icon">
                            <i class="fas fa-gift"></i>
                        </div>
                        <h3 class="benefit-title">Exclusive Bonuses</h3>
                        <p class="benefit-text">Earn performance bonuses, seasonal rewards, and qualify for our luxury
                            incentive trips to exotic destinations worldwide.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="benefit-card fade-in-up">
                        <div class="benefit-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="benefit-title">Dedicated Support</h3>
                        <p class="benefit-text">Get 1-on-1 coaching from affiliate managers, priority support, and
                            personalized strategy sessions to maximize your earnings.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="benefit-card fade-in-up">
                        <div class="benefit-icon">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <h3 class="benefit-title">Recurring Income</h3>
                        <p class="benefit-text">Earn lifetime commissions that keep paying month after month. Build a
                            sustainable passive income stream that grows over time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonial-section" style="margin-top: 100px;">
        <div class="container">
            <h2 class="section-title fade-in-up">Hear From Our <span>Success Stories</span></h2>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card fade-in-up">
                        <div class="testimonial-quote">"</div>
                        <p class="testimonial-text">I was skeptical at first, but the training and support completely
                            transformed my approach. I've earned over $47,000 in my first year working part-time!</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">SJ</div>
                            <div class="author-info">
                                <h5>Sarah Johnson</h5>
                                <p>Digital Marketer</p>
                                <div class="author-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card fade-in-up">
                        <div class="testimonial-quote">"</div>
                        <p class="testimonial-text">The lifetime commissions are incredible! I'm still earning from
                            referrals I made 3 years ago. This program has given me true financial freedom.</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">MR</div>
                            <div class="author-info">
                                <h5>Michael Rodriguez</h5>
                                <p>Entrepreneur</p>
                                <div class="author-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card fade-in-up">
                        <div class="testimonial-quote">"</div>
                        <p class="testimonial-text">The affiliate dashboard is a game-changer. Real-time analytics help me
                            optimize campaigns instantly. Support team is always available when I need help.</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">ET</div>
                            <div class="author-info">
                                <h5>Emily Thompson</h5>
                                <p>Content Creator</p>
                                <div class="author-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" style="margin-top: 100px;">
        <div class="cta-pattern"></div>
        <div class="floating-elements">
            <div class="floating-element" style="background: white;"></div>
            <div class="floating-element" style="background: white;"></div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center cta-content">
                    <h2 class="cta-title">Ready for Your<br>Breakthrough?</h2>
                    <p class="cta-text">Join thousands of successful affiliates who've transformed their income. Start
                        today and get instant access to all our premium resources, training, and support.</p>
                    <button type="button" class="btn btn-success btn-lg px-5 py-3 fw-bold" data-bs-toggle="modal"
                        data-bs-target="#registerModal">
                        <i class="fas fa-user-plus me-2"></i> Start Earning Today - $0 Cost
                    </button>
                    <p class="mt-4 opacity-75">No credit card required • 30-second signup • Instant access</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Begin Your Success Journey</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm" method="POST" action="{{ route('affiliate.register') }}">
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">First Name</label>
                                <input type="text" name="first_name" class="form-control form-control-modern"
                                    required>
                                <div class="text-danger" id="first_name-error"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Last Name</label>
                                <input type="text" name="last_name" class="form-control form-control-modern" required>
                                <div class="text-danger" id="last_name-error"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control form-control-modern" required>
                            <div class="text-danger" id="email-error"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control form-control-modern" required
                                minlength="8">
                            <div class="text-danger" id="password-error"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-modern"
                                required>
                        </div>

                        <div class="form-check mb-4">
                            <input type="checkbox" name="terms" required class="form-check-input">
                            <label class="form-check-label text-muted">
                                I agree to the <a href="#" class="text-primary">Terms</a> & <a href="#"
                                    class="text-primary">Privacy Policy</a>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
                            <span class="submit-text">Create My Affiliate Account</span>
                            <span class="spinner-border spinner-border-sm d-none spinner ms-2"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Welcome Back, Champion!</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" method="POST" action="{{ route('affiliate.login') }}">
    @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control form-control-modern" required>
                            <div class="text-danger" id="login-email-error"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control form-control-modern" required>
                            <div class="text-danger" id="login-password-error"></div>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input">
                                <label class="form-check-label text-muted">Remember me</label>
                            </div>
                            <a href="#" class="text-primary small">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
                            <span class="submit-text">Access My Dashboard</span>
                            <span class="spinner-border spinner-border-sm d-none spinner ms-2"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- SweetAlert2 CDN (No jQuery Required!) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // CSRF Token for Laravel AJAX
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Clear all error messages
        function clearErrors(formId) {
            document.querySelectorAll(`#${formId} .text-danger`).forEach(el => el.textContent = '');
        }

        // ========================
        // REGISTER FORM - AJAX
        // ========================
        document.getElementById('registerForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            clearErrors('registerForm');

            const btn     = this.querySelector('button[type="submit"]');
            const text    = btn.querySelector('.submit-text');
            const spinner = btn.querySelector('.spinner');

            btn.disabled = true;
            text.textContent = 'Creating Account...';
            spinner.classList.remove('d-none');

            fetch("{{ route('affiliate.register') }}", {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Welcome to the Team!',
                    html: 'Your affiliate account is ready!<br><strong>Redirecting...</strong>',
                    timer: 2200,
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = data.redirect || "{{ route('affiliate.dashboard') }}";
                });
            })
            .catch(err => {
                console.error('Register Error:', err);

                if (err.errors) {
                    Object.keys(err.errors).forEach(key => {
                        const errorEl = document.getElementById(key + '-error');
                        if (errorEl) errorEl.textContent = err.errors[key][0];
                    });
                    Swal.fire('Oops!', 'Please fix the errors below', 'warning');
                } else {
                    Swal.fire('Error', err.message || 'Something went wrong!', 'error');
                }
            })
            .finally(() => {
                btn.disabled = false;
                text.textContent = 'Create My Affiliate Account';
                spinner.classList.add('d-none');
            });
        });

        // ========================
        // LOGIN FORM - AJAX
        // ========================
        document.getElementById('loginForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            clearErrors('loginForm');

            const btn     = this.querySelector('button[type="submit"]');
            const text    = btn.querySelector('.submit-text');
            const spinner = btn.querySelector('.spinner');

            btn.disabled = true;
            text.textContent = 'Logging in...';
            spinner.classList.remove('d-none');

            fetch("{{ route('affiliate.login') }}", {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Welcome Back!',
                    text: 'Redirecting to your dashboard...',
                    timer: 1800,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = data.redirect || "{{ route('affiliate.dashboard') }}";
                });
            })
            .catch(err => {
                console.error('Login Error:', err);

                if (err.errors) {
                    Object.keys(err.errors).forEach(key => {
                        const errorEl = document.getElementById('login-' + key + '-error');
                        if (errorEl) errorEl.textContent = err.errors[key][0];
                    });
                }
                Swal.fire('Login Failed', err.message || 'Invalid email or password', 'error');
            })
            .finally(() => {
                btn.disabled = false;
                text.textContent = 'Access My Dashboard';
                spinner.classList.add('d-none');
            });
        });

        // Auto-focus first input in modals
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('shown.bs.modal', () => {
                modal.querySelector('input')?.focus();
            });
        });

        // Progress bar on scroll
        window.addEventListener('scroll', () => {
            const winHeight = window.innerHeight;
            const docHeight = document.documentElement.scrollHeight;
            const scrolled = (window.pageYOffset) / (docHeight - winHeight) * 100;
            document.getElementById('progressBar').style.width = scrolled + '%';
        });

        // Fade-in-up animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));

        // Stats counter animation
        function animateCounter(el, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);
            const timer = setInterval(() => {
                start += increment;
                if (start >= target) {
                    el.textContent = target + '+';
                    clearInterval(timer);
                } else {
                    el.textContent = Math.floor(start) + '+';
                }
            }, 16);
        }

        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const numEl = entry.target;
                    const value = parseInt(numEl.getAttribute('data-count'));
                    if (value) animateCounter(numEl, value);
                    statsObserver.unobserve(numEl);
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.stats-number[data-count]').forEach(el => statsObserver.observe(el));
    </script>
@endsection
