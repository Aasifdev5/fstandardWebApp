@extends('user-master')
@section('title', 'Dashboard')

@push('styles')
<style>
    .metric-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }
    .metric-card {
        background: linear-gradient(135deg, #1a2332 0%, #111827 100%);
        border-radius: 20px;
        padding: 28px;
        text-align: center;
        border: 1px solid #2d3748;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }
    .metric-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; height: 4px;
        background: linear-gradient(90deg, #ff8c00, #ff6b6b);
        opacity: 0;
        transition: opacity 0.3s;
    }
    .metric-card:hover::before { opacity: 1; }
    .metric-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        border-color: #ff8c00;
    }
    .metric-icon {
        width: 80px; height: 80px; margin: 0 auto 20px;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 36px;
    }
    .metric-value {
        font-size: 42px; font-weight: 800; margin: 12px 0;
        background: linear-gradient(90deg, #ff8c00, #ff6b6b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .metric-label {
        color: #94a3b8; font-size: 15px; text-transform: uppercase; letter-spacing: 1.5px;
    }

    .challenge-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 30px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    .challenge-card::after {
        content: '';
        position: absolute;
        top: -50%; right: -50%;
        width: 200%; height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: pulse 8s infinite;
    }
    @keyframes pulse {
         0% { transform: translate(0,0); }
  50% { transform: translate(-10%, -10%); }
  100% { transform: translate(0,0); }
    }

    .progress { height: 12px; border-radius: 6px; background: #1px solid #4a5568; overflow:hidden; }
    .progress-bar { border-radius: 6px; }

    .table-dark { background: #1a2332; }
    .badge-success { background: #22c55e; }
    .badge-danger { background: #ef4444; }
    .badge-warning { background: #f59e0b; }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <h2 class="text-white mb-5 fw-bold">
        <i class="fas fa-tachometer-alt me-3"></i> Welcome back, {{ $user_session->name }}!
    </h2>

    @if($challenge)
        <!-- Active Challenge Card -->
        <div class="challenge-card text-white mb-5 shadow-lg">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="mb-3">{{ $challenge->plan->title ?? '10K Evaluation' }}</h3>
                    <div class="row g-4">
                        <div class="col">
                            <div class="h4 mb-1">₹{{ number_format($challenge->current_balance) }}</div>
                            <small>Current Balance</small>
                        </div>
                        <div class="col">
                            <div class="h4 mb-1 text-success">+₹{{ number_format($challenge->total_profit) }}</div>
                            <small>Net Profit</small>
                        </div>
                        <div class="col">
                            <div class="h4 mb-1">{{ number_format(($challenge->total_profit / $challenge->start_balance) * 100, 2) }}%</div>
                            <small>Return</small>
                        </div>
                        <div class="col">
                            <div class="h4 mb-1">{{ $challenge->valid_days_completed_days }}/5</div>
                            <small>Trading Days</small>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between text-white-50 mb-2">
                            <span>Profit Target (8%)</span>
                            <span>{{ number_format(($challenge->total_profit / $challenge->start_balance) * 100, 2) }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: {{ min(100, ($challenge->total_profit / $challenge->start_balance) * 100 / 8 * 100) }}%"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <div class="display-4 fw-bold">Phase {{ $challenge->phase }}</div>
                    <div class="badge bg-light text-dark fs-6 px-4 py-2 mt-2">{{ ucfirst($challenge->status) }}</div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info text-center py-5">
            <h4>No Active Challenge</h4>
            <p>Purchase a plan to start trading!</p>
            <a href="{{ url('/') }}" class="btn btn-primary btn-lg mt-3">View Plans</a>
        </div>
    @endif

    <!-- Metrics Grid -->
    <div class="metric-grid">
        <div class="metric-card status-open">
            <div class="metric-icon  bg-opacity-20 text-primary"><i class="fas fa-clock"></i></div>
            <div class="metric-label">Open Orders</div>
            <div class="metric-value">{{ $openOrders }}</div>
        </div>
        <div class="metric-card status-completed">
            <div class="metric-icon  bg-opacity-20 text-success"><i class="fas fa-check-circle"></i></div>
            <div class="metric-label">Completed Trades</div>
            <div class="metric-value">{{ $completedTrades }}</div>
        </div>
        <div class="metric-card status-canceled">
            <div class="metric-icon  bg-opacity-20 text-danger"><i class="fas fa-times-circle"></i></div>
            <div class="metric-label">Canceled Orders</div>
            <div class="metric-value">{{ $canceledOrders }}</div>
        </div>
        <div class="metric-card status-total">
            <div class="metric-icon bg-indigo bg-opacity-20 text-indigo"><i class="fas fa-chart-line"></i></div>
            <div class="metric-label">Total P&L</div>
            <div class="metric-value {{ $totalPnL >= 0 ? 'text-success' : 'text-danger' }}">
                {{ $totalPnL >= 0 ? '+' : '' }}₹{{ number_format(abs($totalPnL), 2) }}
            </div>
        </div>
    </div>

    <!-- Recent Orders & Trades -->
    <div class="row g-4">
        <div class="col-lg-6">
            <h3 class="text-white mb-3">Recent Orders</h3>
            @if($recentOrders->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-receipt"></i>
                    <div class="empty-text">No orders placed yet</div>
                </div>
            @else
                <div class="card bg-dark border-0 shadow">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Symbol</th>
                                    <th>Side</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td class="small text-light">{{ $order->created_at->format('d M H:i') }}</td>
                                    <td><strong>{{ $order->stock_symbol }}</strong></td>
                                    <td>{!! $order->side_badge !!}</td>
                                    <td>{!! $order->status_badge !!}</td>
                                    <td>₹{{ number_format($order->total_amount ?? 0, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-6">
            <h3 class="text-white mb-3">Recent Trades</h3>
            @if($recentTrades->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-exchange-alt"></i>
                    <div class="empty-text">No closed trades yet</div>
                </div>
            @else
                <div class="card bg-dark border-0 shadow">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Symbol</th>
                                    <th>Direction</th>
                                    <th>P&L</th>
                                    <th>Holding</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTrades as $trade)
                                <tr>
                                    <td><strong>{{ $trade->symbol }}</strong></td>
                                    <td>
                                        <span class="badge {{ $trade->direction === 'long' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($trade->direction) }}
                                        </span>
                                    </td>
                                    <td class="{{ $trade->profit_loss >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $trade->profit_loss >= 0 ? '+' : '' }}₹{{ number_format(abs($trade->profit_loss), 2) }}
                                    </td>
                                    <td class="small">{{ gmdate('H\hi', $trade->holding_seconds) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
