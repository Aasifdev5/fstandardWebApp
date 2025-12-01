@extends('user-master')
@section('title', 'My Affiliation')

<style>
    :root {
        --primary-color: #4361ee;
        --primary-light: #4895ef;
        --secondary-color: #3a0ca3;
        --success-color: #4cc9f0;
        --danger-color: #f72585;
        --warning-color: #f8961e;
        --dark-bg: #0d1117;
        --card-bg: #161b22;
        --card-border: #30363d;
        --text-primary: #f0f6fc;
        --text-secondary: #8b949e;
        --hover-bg: #21262d;
        --gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    }

    body {
        background: var(--dark-bg);
        min-height: 100vh;
        color: var(--text-primary);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .affiliate-header {
        background: var(--gradient);
        padding: 60px 0 40px;
        position: relative;
        overflow: hidden;
        margin-bottom: 40px;
    }

    .affiliate-header::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -150px;
        right: -100px;
        opacity: 0.3;
    }

    .affiliate-header-content {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        text-align: center;
    }

    .welcome-title {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 15px;
        background: linear-gradient(120deg, #fff 0%, rgba(255,255,255,0.8) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 20px rgba(0,0,0,0.1);
    }

    .welcome-subtitle {
        font-size: 1.2rem;
        color: rgba(255,255,255,0.9);
        margin-bottom: 10px;
        line-height: 1.6;
    }

    .badge-tier {
        display: inline-block;
        padding: 8px 20px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.2);
        font-weight: 600;
        color: white;
        margin-top: 10px;
    }

    .main-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 30px 25px;
        text-align: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4), 0 0 0 1px rgba(67, 97, 238, 0.2);
        border-color: rgba(67, 97, 238, 0.3);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: rgba(67, 97, 238, 0.1);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 1.5rem;
        color: var(--primary-color);
    }

    .stat-value {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 5px;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
    }

    .stat-label {
        color: var(--text-secondary);
        font-size: 0.95rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 10px;
    }

    .referral-section {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }

    .referral-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient);
    }

    .section-title {
        color: var(--text-primary);
        font-weight: 700;
        font-size: 1.4rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-title i {
        color: var(--primary-color);
        background: rgba(67, 97, 238, 0.1);
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .referral-link-container {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--card-border);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        position: relative;
    }

    .referral-link {
        font-family: 'SF Mono', 'Monaco', 'Inconsolata', 'Fira Code', monospace;
        color: var(--text-primary);
        font-size: 1.1rem;
        word-break: break-all;
        padding-right: 60px;
    }

    .copy-btn {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: var(--gradient);
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .copy-btn:hover {
        transform: translateY(-50%) scale(1.05);
        box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
    }

    .referral-code-display {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(67, 97, 238, 0.1);
        padding: 12px 20px;
        border-radius: 12px;
        border: 1px solid rgba(67, 97, 238, 0.2);
        margin-top: 15px;
    }

    .referral-code {
        font-family: 'SF Mono', monospace;
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--primary-color);
    }

    .share-buttons {
        display: flex;
        gap: 10px;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .share-btn {
        flex: 1;
        min-width: 120px;
        padding: 12px;
        border-radius: 10px;
        border: 1px solid var(--card-border);
        background: rgba(255, 255, 255, 0.03);
        color: var(--text-primary);
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .share-btn:hover {
        background: var(--hover-bg);
        border-color: var(--primary-color);
        transform: translateY(-2px);
    }

    .share-btn.whatsapp {
        color: #25D366;
    }

    .share-btn.facebook {
        color: #1877F2;
    }

    .share-btn.twitter {
        color: #1DA1F2;
    }

    .share-btn.email {
        color: #EA4335;
    }

    .rewards-section {
        margin-top: 40px;
    }

    .reward-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .reward-card:hover {
        border-color: var(--primary-color);
        transform: translateY(-5px);
    }

    .reward-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .reward-title {
        color: var(--text-primary);
        font-weight: 600;
        font-size: 1.1rem;
    }

    .reward-amount {
        color: var(--success-color);
        font-weight: 700;
        font-size: 1.2rem;
    }

    .reward-description {
        color: var(--text-secondary);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .progress-container {
        margin-top: 15px;
    }

    .progress-bar {
        height: 8px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 8px;
    }

    .progress-fill {
        height: 100%;
        background: var(--gradient);
        border-radius: 4px;
        transition: width 0.6s ease;
    }

    .progress-text {
        display: flex;
        justify-content: space-between;
        color: var(--text-secondary);
        font-size: 0.85rem;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-secondary);
    }

    .empty-state-icon {
        font-size: 5rem;
        color: var(--primary-color);
        opacity: 0.2;
        margin-bottom: 20px;
        display: inline-block;
    }

    .empty-state h5 {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 1.5rem;
    }

    .empty-state p {
        color: var(--text-secondary);
        font-size: 1rem;
        max-width: 500px;
        margin: 0 auto 30px;
        line-height: 1.6;
    }

    .btn-primary-custom {
        background: var(--gradient);
        border: none;
        color: white;
        padding: 14px 32px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 0.5px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-primary-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(67, 97, 238, 0.3);
    }

    .btn-primary-custom::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.7s ease;
    }

    .btn-primary-custom:hover::before {
        left: 100%;
    }

    .recent-activity {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 30px;
        margin-top: 40px;
    }

    .activity-item {
        display: flex;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        background: rgba(67, 97, 238, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        margin-right: 15px;
    }

    .activity-details {
        flex: 1;
    }

    .activity-title {
        color: var(--text-primary);
        font-weight: 500;
        margin-bottom: 5px;
    }

    .activity-time {
        color: var(--text-secondary);
        font-size: 0.85rem;
    }

    .activity-amount {
        color: var(--success-color);
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .welcome-title {
            font-size: 2.2rem;
        }

        .welcome-subtitle {
            font-size: 1.1rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .referral-link {
            font-size: 0.95rem;
            padding-right: 0;
            margin-bottom: 15px;
        }

        .copy-btn {
            position: relative;
            top: 0;
            right: 0;
            transform: none;
            width: 100%;
            justify-content: center;
        }

        .share-buttons {
            flex-direction: column;
        }

        .share-btn {
            min-width: 100%;
        }
    }
</style>


@section('content')
<!-- Affiliate Header -->
<section class="affiliate-header">
    <div class="affiliate-header-content">
        <h1 class="welcome-title">Welcome back, {{ auth()->user()->name ?? 'User' }}!</h1>
        <p class="welcome-subtitle">Earn rewards by sharing your referral link with friends and family</p>
        <div class="badge-tier">Standard Affiliate</div>
    </div>
</section>

<!-- Main Content -->
<div class="main-container">
    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="stat-value">₹{{ number_format(auth()->user()->balance ?? 0, 2) }}</div>
            <div class="stat-label">Total Earnings</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-percentage"></i>
            </div>
            <div class="stat-value">18%</div>
            <div class="stat-label">Commission Rate</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-value">{{ auth()->user()->referrals_count ?? 0 }}</div>
            <div class="stat-label">Total Referrals</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-gift"></i>
            </div>
            <div class="stat-value">₹{{ number_format((auth()->user()->balance ?? 0) * 0.18, 2) }}</div>
            <div class="stat-label">Available Payout</div>
        </div>
    </div>

    <!-- Referral Section -->
    <div class="referral-section">
        <h3 class="section-title">
            <i class="fas fa-link"></i>
            Your Referral Link
        </h3>

        <div class="referral-link-container">
            <div class="referral-link" id="referralLink">
                {{ url('signup') }}?ref={{ auth()->user()->referral_code ?? 'YOURCODE' }}
            </div>
            <button class="copy-btn" onclick="copyReferralLink()">
                <i class="fas fa-copy"></i> Copy Link
            </button>
        </div>

        <div>
            <div class="referral-code-display">
                <span>Your Referral Code:</span>
                <code class="referral-code">{{ auth()->user()->referral_code ?? 'YOURCODE' }}</code>
            </div>
        </div>

        <div class="share-buttons">
            <button class="share-btn whatsapp" onclick="shareViaWhatsApp()">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </button>
            <button class="share-btn facebook" onclick="shareViaFacebook()">
                <i class="fab fa-facebook"></i> Facebook
            </button>
            <button class="share-btn twitter" onclick="shareViaTwitter()">
                <i class="fab fa-twitter"></i> Twitter
            </button>
            <button class="share-btn email" onclick="shareViaEmail()">
                <i class="fas fa-envelope"></i> Email
            </button>
        </div>
    </div>

    <!-- Rewards Section -->
    <div class="rewards-section">
        <h3 class="section-title">
            <i class="fas fa-trophy"></i>
            Your Rewards Progress
        </h3>

        @if(auth()->user()->referrals_count ?? 0 > 0)
            <div class="reward-card">
                <div class="reward-header">
                    <div class="reward-title">Bronze Tier</div>
                    <div class="reward-amount">$50 Bonus</div>
                </div>
                <p class="reward-description">Refer 5 friends to unlock your Bronze tier bonus</p>
                <div class="progress-container">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ min(100, ((auth()->user()->referrals_count ?? 0) / 5) * 100) }}%"></div>
                    </div>
                    <div class="progress-text">
                        <span>{{ auth()->user()->referrals_count ?? 0 }}/5 referrals</span>
                        <span>{{ min(100, ((auth()->user()->referrals_count ?? 0) / 5) * 100) }}%</span>
                    </div>
                </div>
            </div>

            <div class="reward-card">
                <div class="reward-header">
                    <div class="reward-title">Silver Tier</div>
                    <div class="reward-amount">$200 Bonus</div>
                </div>
                <p class="reward-description">Refer 20 friends to unlock your Silver tier bonus</p>
                <div class="progress-container">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ min(100, ((auth()->user()->referrals_count ?? 0) / 20) * 100) }}%"></div>
                    </div>
                    <div class="progress-text">
                        <span>{{ auth()->user()->referrals_count ?? 0 }}/20 referrals</span>
                        <span>{{ min(100, ((auth()->user()->referrals_count ?? 0) / 20) * 100) }}%</span>
                    </div>
                </div>
            </div>

            <div class="reward-card">
                <div class="reward-header">
                    <div class="reward-title">Gold Tier</div>
                    <div class="reward-amount">$500 Bonus</div>
                </div>
                <p class="reward-description">Refer 50 friends to unlock your Gold tier bonus</p>
                <div class="progress-container">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ min(100, ((auth()->user()->referrals_count ?? 0) / 50) * 100) }}%"></div>
                    </div>
                    <div class="progress-text">
                        <span>{{ auth()->user()->referrals_count ?? 0 }}/50 referrals</span>
                        <span>{{ min(100, ((auth()->user()->referrals_count ?? 0) / 50) * 100) }}%</span>
                    </div>
                </div>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h5>No Referrals Yet</h5>
                <p>Start sharing your referral link to earn rewards!</p>
                <p class="text-secondary mt-3">
                    <i class="fas fa-lightbulb me-2"></i>
                    Share your unique link with friends and family to start earning commissions
                </p>
            </div>
        @endif
    </div>

    <!-- Recent Activity -->
    @if(auth()->user()->referrals_count ?? 0 > 0)
        <div class="recent-activity">
            <h3 class="section-title">
                <i class="fas fa-history"></i>
                Recent Activity
            </h3>

            @if(auth()->user()->recent_referrals ?? [])
                @foreach(auth()->user()->recent_referrals as $referral)
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="activity-details">
                            <div class="activity-title">New referral: {{ $referral->name ?? 'User' }}</div>
                            <div class="activity-time">{{ $referral->created_at->diffForHumans() ?? 'Recently' }}</div>
                        </div>
                        <div class="activity-amount">+${{ number_format($referral->commission ?? 0, 2) }}</div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h5>No Recent Activity</h5>
                    <p>Your referral activity will appear here</p>
                </div>
            @endif
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Copy referral link
    function copyReferralLink() {
        const link = document.getElementById('referralLink').textContent;
        navigator.clipboard.writeText(link).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Copied!',
                text: 'Referral link copied to clipboard',
                timer: 1500,
                showConfirmButton: false,
                background: '#161b22',
                color: '#f0f6fc'
            });

            // Update button text temporarily
            const btn = event.target.closest('.copy-btn');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
            setTimeout(() => {
                btn.innerHTML = originalText;
            }, 2000);
        });
    }

    // Share via WhatsApp
    function shareViaWhatsApp() {
        const link = encodeURIComponent(document.getElementById('referralLink').textContent);
        const text = encodeURIComponent("Join me and earn rewards! Use my referral link: ");
        window.open(`https://wa.me/?text=${text}${link}`, '_blank');
    }

    // Share via Facebook
    function shareViaFacebook() {
        const link = encodeURIComponent(document.getElementById('referralLink').textContent);
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${link}`, '_blank');
    }

    // Share via Twitter
    function shareViaTwitter() {
        const link = encodeURIComponent(document.getElementById('referralLink').textContent);
        const text = encodeURIComponent("Join me and earn rewards! Use my referral link: ");
        window.open(`https://twitter.com/intent/tweet?text=${text}&url=${link}`, '_blank');
    }

    // Share via Email
    function shareViaEmail() {
        const link = document.getElementById('referralLink').textContent;
        const subject = encodeURIComponent("Join me and earn rewards!");
        const body = encodeURIComponent(`Hey there!\n\nI wanted to share my referral link with you. Join using this link to get started:\n\n${link}\n\nLooking forward to having you on board!`);
        window.location.href = `mailto:?subject=${subject}&body=${body}`;
    }

    // Initialize tooltips
    $(document).ready(function() {
        $('[title]').tooltip({
            placement: 'top',
            trigger: 'hover'
        });

        // Auto-animate progress bars
        setTimeout(() => {
            $('.progress-fill').each(function() {
                const width = $(this).attr('style').match(/width: (.*?)%/)[1];
                $(this).css('width', '0%').animate({
                    width: width + '%'
                }, 1000);
            });
        }, 500);
    });
</script>
@endsection
