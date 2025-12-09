@extends('layout.master')
@section('title', 'Admin - Live Positions')

@section('main_content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white">Live Positions</h2>
        <button class="btn btn-outline-info btn-sm" onclick="location.reload()">
            <i class="fas fa-sync-alt"></i> Refresh
        </button>
    </div>

    @if(empty($positions) || count($positions) == 0)
        <div class="text-center py-5 text-muted">
            <i class="fas fa-chart-line fa-4x mb-3"></i>
            <h5>No open positions</h5>
        </div>
    @else
        <div class="row g-4">
            @foreach($positions as $pos)
            <div class="col-md-6 col-lg-4">
                <div class="card bg-dark border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $pos['tradingSymbol'] ?? '—' }}</h5>
                        <div class="row text-center">
                            <div class="col">
                                <small class="text-muted">Net Qty</small>
                                <div class="h5 mb-0 {{ ($pos['netQty'] ?? 0) > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $pos['netQty'] ?? 0 }}
                                </div>
                            </div>
                            <div class="col">
                                <small class="text-muted">Avg Price</small>
                                <div class="h5 mb-0">₹{{ number_format($pos['avgPrice'] ?? 0, 2) }}</div>
                            </div>
                            <div class="col">
                                <small class="text-muted">P&L</small>
                                <div class="h5 mb-0 {{ ($pos['pnl'] ?? 0) >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ ($pos['pnl'] ?? 0) >= 0 ? '+' : '' }}₹{{ number_format(abs($pos['pnl'] ?? 0), 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
