@extends('layout.master')
@section('title', 'Admin Dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js">
<style>
    .stat-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #334155;
        transition: all 0.3s;
    }
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        border-color: #f59e0b;
    }
    .stat-value {
        font-size: 42px;
        font-weight: 800;
        background: linear-gradient(90deg, #f59e0b, #f97316);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .chart-container {
        position: relative;
        height: 350px;
        background: #1e293b;
        border-radius: 16px;
        padding: 20px;
    }
</style>
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Admin Dashboard</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Admin Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid dashboard-default">
    <!-- Stats Grid -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="stat-card text-center">
                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                <div class="stat-value">{{ $totalUsers }}</div>
                <p class="text-muted mb-0">Total Users</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card text-center">
                <i class="fas fa-trophy fa-3x text-success mb-3"></i>
                <div class="stat-value">{{ $activeChallenges }}</div>
                <p class="text-muted mb-0">Active Challenges</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card text-center">
                <i class="fas fa-chart-line fa-3x text-warning mb-3"></i>
                <div class="stat-value">₹{{ number_format($monthlyPnL, 0) }}</div>
                <p class="text-muted mb-0">Monthly P&L</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card text-center">
                <i class="fas fa-shopping-cart fa-3x text-info mb-3"></i>
                <div class="stat-value">{{ $todayOrders }}</div>
                <p class="text-muted mb-0">Today's Orders</p>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4">
        <!-- Monthly P&L Chart -->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h5>Monthly Profit & Loss</h5>
                </div>
                <div class="card-body chart-container">
                    <canvas id="pnlChart"></canvas>
                </div>
            </div>
        </div>

        <!-- User Growth -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5>User Registration Trend</h5>
                </div>
                <div class="card-body chart-container">
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Activity</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Symbol</th>
                                    <th>P&L</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTrades as $trade)
                                <tr>
                                    <td>{{ $trade->user->name }}</td>
                                    <td>
                                        <span class="badge {{ $trade->profit_loss >= 0 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $trade->direction === 'long' ? 'LONG' : 'SHORT' }}
                                        </span>
                                    </td>
                                    <td><strong>{{ $trade->symbol }}</strong></td>
                                    <td class="{{ $trade->profit_loss >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $trade->profit_loss >= 0 ? '+' : '' }}₹{{ abs($trade->profit_loss) }}
                                    </td>
                                    <td>{{ $trade->exit_time->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Monthly P&L Chart
    const pnlCtx = document.getElementById('pnlChart').getContext('2d');
    new Chart(pnlCtx, {
        type: 'line',
        data: {
            labels: @json($monthlyLabels),
            datasets: [{
                label: 'Monthly P&L (₹)',
                data: @json($monthlyData),
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#10b981',
                pointRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: false, grid: { color: '#334155' } },
                x: { grid: { display: false } }
            }
        }
    });

    // User Growth Chart
    const userCtx = document.getElementById('userChart').getContext('2d');
    new Chart(userCtx, {
        type: 'doughnut',
        data: {
            labels: ['This Month', 'Last Month'],
            datasets: [{
                data: [{{ $thisMonthUsers }}, {{ $lastMonthUsers }}],
                backgroundColor: ['#f59e0b', '#475569'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endsection
@endsection
