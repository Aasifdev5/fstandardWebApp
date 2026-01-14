@extends('user-master')
@section('title', 'Dashboard')

@push('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        --dark-bg: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    }

    body {
        background: #0f172a;
        color: #e2e8f0;
    }

    .metric-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .metric-card {
        background: var(--dark-bg);
        border-radius: 20px;
        padding: 28px;
        border: 1px solid #334155;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .metric-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.03), transparent);
        opacity: 0;
        transition: opacity 0.4s;
    }

    .metric-card:hover::before {
        opacity: 1;
    }

    .metric-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        border-color: #475569;
    }

    .metric-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 20px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .metric-value {
        font-size: 40px;
        font-weight: 800;
        margin: 12px 0;
        font-family: 'Inter', sans-serif;
    }

    .metric-label {
        color: #94a3b8;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .status-open .metric-value { color: #3b82f6; }
    .status-completed .metric-value { color: #22c55e; }
    .status-canceled .metric-value { color: #ef4444; }
    .status-total .metric-value { color: #8b5cf6; }

    /* Challenge Card */
    .challenge-card {
        background: var(--primary-gradient);
        border-radius: 24px;
        padding: 32px;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 32px;
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.2);
    }

    .challenge-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: pulse 8s infinite;
    }

    @keyframes pulse {
        0% { transform: translate(0,0) scale(1); }
        50% { transform: translate(-10%, -10%) scale(1.1); }
        100% { transform: translate(0,0) scale(1); }
    }

    /* Progress Bars */
    .progress-container {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        height: 12px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        border-radius: 10px;
        transition: width 1s ease-in-out;
        position: relative;
        overflow: hidden;
    }

    .progress-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(255,255,255,0.3) 50%,
            transparent 100%);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    /* Cards */
    .card-custom {
        background: var(--dark-bg);
        border: 1px solid #334155;
        border-radius: 20px;
        overflow: hidden;
    }

    .card-header-custom {
        background: rgba(30, 41, 59, 0.5);
        border-bottom: 1px solid #334155;
        padding: 20px 24px;
    }

    /* Tables */
    .table-custom {
        background: transparent;
        color: #e2e8f0;
    }

    .table-custom thead th {
        border-bottom: 1px solid #334155;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 1px;
    }

    .table-custom tbody tr {
        border-bottom: 1px solid #334155;
        transition: background 0.3s;
    }

    .table-custom tbody tr:hover {
        background: rgba(255, 255, 255, 0.03);
    }

    /* Badges */
    .badge-pill {
        padding: 6px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 12px;
    }

    /* Empty States */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }

    .empty-state i {
        font-size: 64px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }

    .stat-item {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 20px;
        text-align: center;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .metric-grid {
            grid-template-columns: 1fr;
        }

        .challenge-card {
            padding: 24px;
        }

        .metric-value {
            font-size: 32px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <!-- Header with Welcome Message -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="text-white mb-2 fw-bold">
                <i class="fas fa-tachometer-alt me-3"></i> Dashboard Overview
            </h2>
            <p class="text-light mb-0">Welcome back, <span class="fw-semibold text-warning">{{ $user_session->name }}</span>!</p>
        </div>
        <div class="text-end">
            <div class="text-light small">
                <i class="fas fa-calendar-alt me-2"></i>
                {{ now()->format('l, F j, Y') }}
            </div>
            <div class="text-light small">
                <i class="fas fa-clock me-2"></i>
                {{ now()->format('h:i A') }}
            </div>
        </div>
    </div>

    @if($challenge)
        <!-- Active Challenge Section -->
        <div class="challenge-card">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <i class="fas fa-trophy fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-1">{{ $challenge->planPurchase->plan->title ?? 'Evaluation Challenge' }}</h3>
                            <p class="mb-0 opacity-75">Account ID: {{ $challenge->account_id ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="stats-grid mb-4">
                        <div class="stat-item">
                            <div class="h4 mb-1 text-white">₹{{ number_format($challenge->current_balance) }}</div>
                            <small class="opacity-75">Current Balance</small>
                        </div>
                        <div class="stat-item">
                            <div class="h4 mb-1 {{ $challenge->total_profit >= 0 ? 'text-success' : 'text-danger' }}">
                                ₹{{ number_format(abs($challenge->total_profit), 2) }}
                            </div>
                            <small class="opacity-75">Net Profit</small>
                        </div>
                        <div class="stat-item">
                            <div class="h4 mb-1 {{ $challenge->total_profit >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ number_format(($challenge->total_profit / $challenge->start_balance) * 100, 2) }}%
                            </div>
                            <small class="opacity-75">Return</small>
                        </div>
                        <div class="stat-item">
                            <div class="h4 mb-1 text-warning">{{ $challenge->valid_days_completed_days ?? 0 }}/{{ $challenge->min_days_required ?? 5 }}</div>
                            <small class="opacity-75">Trading Days</small>
                        </div>
                    </div>

                    <!-- Progress Bars -->
                    @if($challengeProgress)
                    <div class="space-y-4">
                        <!-- Profit Target -->
                        <div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="opacity-90">Profit Target ({{ $challenge->profit_target_percent ?? 8 }}%)</span>
                                <span class="fw-semibold">{{ number_format($challengeProgress['current_profit_percent'], 2) }}%</span>
                            </div>
                            <div class="progress-container">
                                <div class="progress-bar bg-success" style="width: {{ $challengeProgress['progress_percent'] }}%"></div>
                            </div>
                        </div>

                        <!-- Drawdown Limits -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="opacity-90">Daily Drawdown</span>
                                    <span class="fw-semibold {{ $challengeProgress['daily_drawdown_percent'] > ($challenge->max_daily_loss_percent ?? 5) ? 'text-danger' : 'text-success' }}">
                                        {{ number_format($challengeProgress['daily_drawdown_percent'], 2) }}%
                                    </span>
                                </div>
                                <div class="progress-container">
                                    <div class="progress-bar {{ $challengeProgress['daily_drawdown_percent'] > ($challenge->max_daily_loss_percent ?? 5) ? 'bg-danger' : 'bg-warning' }}"
                                         style="width: {{ min(100, ($challengeProgress['daily_drawdown_percent'] / ($challenge->max_daily_loss_percent ?? 5)) * 100) }}%"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="opacity-90">Overall Drawdown</span>
                                    <span class="fw-semibold {{ $challengeProgress['overall_drawdown_percent'] > ($challenge->max_overall_loss_percent ?? 10) ? 'text-danger' : 'text-success' }}">
                                        {{ number_format($challengeProgress['overall_drawdown_percent'], 2) }}%
                                    </span>
                                </div>
                                <div class="progress-container">
                                    <div class="progress-bar {{ $challengeProgress['overall_drawdown_percent'] > ($challenge->max_overall_loss_percent ?? 10) ? 'bg-danger' : 'bg-info' }}"
                                         style="width: {{ min(100, ($challengeProgress['overall_drawdown_percent'] / ($challenge->max_overall_loss_percent ?? 10)) * 100) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-lg-4 text-center">
                    <div class="position-relative">
                        <div class="display-1 fw-bold mb-2">Phase {{ $challenge->phase }}</div>
                        <div class="badge bg-white text-dark px-4 py-2 fs-6 mb-4">
                            {{ ucfirst($challenge->status) }}
                        </div>

                        @if($challengeProgress && $challengeProgress['days_remaining'] > 0)
                        <div class="mt-4">
                            <div class="text-white-50 mb-1">Days Remaining</div>
                            <div class="display-5 fw-bold text-warning">{{ $challengeProgress['days_remaining'] }}</div>
                        </div>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('market.index') }}" class="btn btn-light btn-lg px-4">
                                <i class="fas fa-chart-line me-2"></i> Start Trading
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($hasActivePlan)
        <!-- Plan Purchased but No Active Challenge -->
        <div class="alert alert-info bg-dark border-info">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle fa-2x"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h4 class="alert-heading">Plan Ready for Activation</h4>
                    <p>You have an approved plan purchase. Click below to activate your trading challenge.</p>
                    <a href="{{ url('challenges.activate') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-play-circle me-2"></i> Activate Challenge
                    </a>
                </div>
            </div>
        </div>
    @else
        <!-- No Plan or Challenge -->
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="fas fa-chart-line fa-4x mb-4"></i>
                <h3 class="text-white mb-3">No Active Challenge</h3>
                <p class="text-light mb-4">Purchase a plan to start your trading journey!</p>
                <a href="{{ url('/') }}" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-gem me-2"></i> View Available Plans
                </a>
            </div>
        </div>
    @endif

    <!-- Performance Metrics -->
    @if($challenge)
    <div class="metric-grid">
        <div class="metric-card status-open">
            <div class="metric-icon">
                <i class="fas fa-clock text-primary"></i>
            </div>
            <div class="metric-label">Open Orders</div>
            <div class="metric-value">{{ $openOrders }}</div>
            <div class="text-light small mt-2">Pending execution</div>
        </div>

        <div class="metric-card status-completed">
            <div class="metric-icon">
                <i class="fas fa-check-circle text-success"></i>
            </div>
            <div class="metric-label">Completed Trades</div>
            <div class="metric-value">{{ $completedTrades }}</div>
            <div class="text-light small mt-2">Total closed trades</div>
        </div>

        <div class="metric-card status-canceled">
            <div class="metric-icon">
                <i class="fas fa-times-circle text-danger"></i>
            </div>
            <div class="metric-label">Canceled Orders</div>
            <div class="metric-value">{{ $canceledOrders }}</div>
            <div class="text-light small mt-2">Rejected or cancelled</div>
        </div>

        <div class="metric-card status-total">
            <div class="metric-icon">
                <i class="fas fa-chart-line text-purple"></i>
            </div>
            <div class="metric-label">Total P&L</div>
            <div class="metric-value {{ $totalPnL >= 0 ? 'text-success' : 'text-danger' }}">
                {{ $totalPnL >= 0 ? '+' : '' }}₹{{ number_format(abs($totalPnL), 2) }}
            </div>
            <div class="text-light small mt-2">Overall profit/loss</div>
        </div>
    </div>
    @endif

    <!-- Recent Activity -->
    <div class="row g-4">
        <!-- Recent Orders -->
        <div class="col-lg-6">
            <div class="card-custom">
                <div class="card-header-custom">
                    <h5 class="mb-0">
                        <i class="fas fa-receipt me-2"></i> Recent Orders
                        <span class="badge bg-primary rounded-pill ms-2">{{ $recentOrders->count() }}</span>
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($recentOrders->isEmpty())
                        <div class="empty-state py-4">
                            <i class="fas fa-receipt fa-2x mb-3"></i>
                            <div class="empty-text">No orders placed yet</div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">Time</th>
                                        <th>Symbol</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th class="pe-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="small">{{ $order->created_at->format('H:i') }}</div>
                                            <div class="text-light smaller">{{ $order->created_at->format('M d') }}</div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ $order->stock_symbol }}</div>
                                            <div class="text-light small">{{ $order->product_type }}</div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $order->order_side == 1 ? 'bg-success' : 'bg-danger' }} badge-pill">
                                                {{ $order->order_side == 1 ? 'BUY' : 'SELL' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">₹{{ number_format($order->total_amount ?? 0, 2) }}</div>
                                            <div class="text-light small">Qty: {{ $order->quantity }}</div>
                                        </td>
                                        <td class="pe-4">
                                            @php
                                                $statusConfig = [
                                                    0 => ['class' => 'warning', 'label' => 'Pending'],
                                                    1 => ['class' => 'success', 'label' => 'Filled'],
                                                    9 => ['class' => 'danger', 'label' => 'Canceled']
                                                ];
                                                $status = $statusConfig[$order->status] ?? ['class' => 'secondary', 'label' => 'Unknown'];
                                            @endphp
                                            <span class="badge bg-{{ $status['class'] }} badge-pill">
                                                {{ $status['label'] }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Trades -->
        <div class="col-lg-6">
            <div class="card-custom">
                <div class="card-header-custom">
                    <h5 class="mb-0">
                        <i class="fas fa-exchange-alt me-2"></i> Recent Trades
                        <span class="badge bg-success rounded-pill ms-2">{{ $recentTrades->count() }}</span>
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($recentTrades->isEmpty())
                        <div class="empty-state py-4">
                            <i class="fas fa-exchange-alt fa-2x mb-3"></i>
                            <div class="empty-text">No closed trades yet</div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">Symbol</th>
                                        <th>Side</th>
                                        <th>Entry</th>
                                        <th>Exit</th>
                                        <th class="pe-4">P&L</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentTrades as $trade)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-semibold">{{ $trade->symbol }}</div>
                                            <div class="text-light small">{{ $trade->quantity }}</div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $trade->direction === 'long' ? 'bg-success' : 'bg-danger' }} badge-pill">
                                                {{ strtoupper(substr($trade->direction, 0, 1)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="small">₹{{ number_format($trade->entry_price, 2) }}</div>
                                            <div class="text-light smaller">{{ $trade->entry_time->format('H:i') }}</div>
                                        </td>
                                        <td>
                                            <div class="small">₹{{ number_format($trade->exit_price, 2) }}</div>
                                            <div class="text-light smaller">{{ $trade->exit_time->format('H:i') }}</div>
                                        </td>
                                        <td class="pe-4">
                                            <div class="fw-bold {{ $trade->profit_loss >= 0 ? 'text-success' : 'text-danger' }}">
                                                {{ $trade->profit_loss >= 0 ? '+' : '' }}₹{{ number_format(abs($trade->profit_loss), 2) }}
                                            </div>
                                            @if($trade->holding_seconds)
                                            <div class="text-light small">
                                                {{ floor($trade->holding_seconds / 3600) }}h {{ floor(($trade->holding_seconds % 3600) / 60) }}m
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Footer -->
    @if($challenge)
    <div class="mt-5 pt-4 border-top border-dark">
        <div class="row">
            <div class="col-md-3 col-6 text-center">
                <div class="text-light small mb-1">Total Trades</div>
                <div class="h5">{{ $completedTrades + $canceledOrders + $openOrders }}</div>
            </div>
            <div class="col-md-3 col-6 text-center">
                <div class="text-light small mb-1">Win Rate</div>
                <div class="h5 {{ $completedTrades > 0 ? 'text-success' : 'text-light' }}">
                    {{ $completedTrades > 0 ? 'Calculating...' : '0%' }}
                </div>
            </div>
            <div class="col-md-3 col-6 text-center">
                <div class="text-light small mb-1">Avg. Trade</div>
                <div class="h5 {{ $completedTrades > 0 ? ($totalPnL/$completedTrades >= 0 ? 'text-success' : 'text-danger') : 'text-light' }}">
                    {{ $completedTrades > 0 ? '₹' . number_format(abs($totalPnL/$completedTrades), 2) : '₹0.00' }}
                </div>
            </div>
            <div class="col-md-3 col-6 text-center">
                <div class="text-light small mb-1">Active Since</div>
                <div class="h5">{{ $challenge->created_at->format('M d, Y') }}</div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
    // Auto-refresh dashboard every 30 seconds
    let refreshTimer;

    function refreshDashboard() {
        clearTimeout(refreshTimer);

        fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            // Create temporary container to parse new content
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;

            // Update only specific parts (like metrics and recent activity)
            const elementsToUpdate = [
                '.metric-grid',
                '.recent-orders-container',
                '.recent-trades-container',
                '.challenge-card'
            ];

            elementsToUpdate.forEach(selector => {
                const newContent = tempDiv.querySelector(selector);
                const currentContent = document.querySelector(selector);
                if (newContent && currentContent) {
                    currentContent.innerHTML = newContent.innerHTML;
                }
            });

            // Reinitialize tooltips if any
            if (typeof bootstrap !== 'undefined') {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }
        })
        .catch(error => console.error('Refresh failed:', error))
        .finally(() => {
            refreshTimer = setTimeout(refreshDashboard, 30000); // 30 seconds
        });
    }

    // Start auto-refresh only if user is active
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            refreshTimer = setTimeout(refreshDashboard, 30000);
        } else {
            clearTimeout(refreshTimer);
        }
    });

    // Initial setup
    if (!document.hidden) {
        refreshTimer = setTimeout(refreshDashboard, 30000);
    }

    // Add animation on card hover
    document.querySelectorAll('.metric-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
</script>
@endpush
@endsection
