@extends('user-master')
@section('title', 'Trade History')

@push('styles')
<style>
    /* Modern Gradient Background */
    .gradient-bg {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
    }

    /* Enhanced Win Rate Display */
    .win-rate-display {
        font-size: 64px;
        font-weight: 900;
        background: linear-gradient(90deg, #22c55e, #16a34a, #10b981);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 4px 20px rgba(34, 197, 94, 0.3);
        position: relative;
        display: inline-block;
    }
    .win-rate-display::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 10%;
        width: 80%;
        height: 4px;
        background: linear-gradient(90deg, #22c55e, #16a34a);
        border-radius: 2px;
    }

    /* Stats Cards */
    .stat-card {
        background: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        transition: left 0.7s;
    }
    .stat-card:hover::before { left: 100%; }
    .stat-card:hover { transform: translateY(-8px); border-color: #f59e0b; box-shadow: 0 20px 40px rgba(0,0,0,0.4); }

    /* Trade Cards */
    .trade-card {
        background: linear-gradient(145deg, #1e293b 0%, #0f172a 100%);
        border-radius: 16px;
        border: 1px solid rgba(51, 65, 85, 0.5);
        transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
        position: relative;
        overflow: hidden;
    }
    .trade-card:hover { transform: translateY(-6px) scale(1.02); border-color: #f59e0b; box-shadow: 0 20px 60px rgba(245,158,11,0.2); }

    /* Profit/Loss */
    .profit-positive { color: #22c55e; font-weight: bold; }
    .profit-negative { color: #ef4444; font-weight: bold; }

    /* Badge Enhancement */
    .badge-long { background: linear-gradient(135deg, #22c55e, #16a34a); border-radius: 20px; padding: 6px 16px; font-weight: 600; }
    .badge-short { background: linear-gradient(135deg, #ef4444, #dc2626); border-radius: 20px; padding: 6px 16px; font-weight: 600; }

    /* Scrollbar */
    .custom-scrollbar::-webkit-scrollbar { width: 8px; height: 8px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: rgba(30,41,59,0.5); border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: linear-gradient(180deg,#f59e0b,#d97706); border-radius: 10px; }

    /* Empty State */
    .empty-state { background: linear-gradient(135deg, rgba(30,41,59,0.8), rgba(15,23,42,0.8)); border-radius: 20px; padding: 60px 20px; border: 2px dashed rgba(245,158,11,0.3); text-align:center; }
</style>
@endpush

@section('content')
<div class="container-fluid py-4 gradient-bg">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white fw-bold"><i class="fas fa-chart-line me-2 text-warning"></i>Trade History</h2>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-warning" onclick="exportTable()"><i class="fas fa-file-export me-1"></i> Export CSV</button>
            <button class="btn btn-warning" id="refreshBtn"><i class="fas fa-sync-alt me-1"></i> Refresh</button>
        </div>
    </div>

    <!-- Stats -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card p-3 text-center">
                <div class="win-rate-display">{{ $winRate }}%</div>
                <small class="text-light opacity-75">Win Rate</small>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card p-3 text-center">
                <div class="fs-2 fw-bold text-warning">{{ $totalTrades }}</div>
                <small class="text-light opacity-75">Total Trades</small>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card p-3 text-center">
                <div class="fs-2 fw-bold {{ $netProfit>=0?'text-success':'text-danger' }}">₹{{ number_format($netProfit,2) }}</div>
                <small class="text-light opacity-75">Net P&L</small>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card p-3 text-center">
                <div class="fs-2 fw-bold text-info">{{ $avgHolding }}</div>
                <small class="text-light opacity-75">Avg Holding</small>
            </div>
        </div>
    </div>

    <!-- Trade Table -->
    @if($trades->isEmpty())
        <div class="empty-state">
            <i class="fas fa-history fa-4x mb-3 text-warning opacity-50"></i>
            <h4 class="text-white mb-2">No trades recorded yet</h4>
            <p class="text-light opacity-75 mb-3">Start trading to see your history here</p>
        </div>
    @else
        <div class="table-responsive custom-scrollbar" style="max-height:600px;">
            <table class="table table-dark table-hover mb-0" id="basic-1">
                <thead class="table-dark sticky-top">
                    <tr>
                        <th>Date & Time</th>
                        <th>Symbol</th>
                        <th>Direction</th>
                        <th>Entry/Exit</th>
                        <th>Qty</th>
                        <th>P&L</th>
                        <th>% Return</th>
                        <th>Holding</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trades as $trade)
                        <tr class="trade-card">
                            <td>{{ $trade->exit_time->format('d M Y H:i') }}</td>
                            <td>{{ $trade->symbol }}</td>
                            <td>
                                <span class="badge {{ $trade->direction==='long'?'badge-long':'badge-short' }}">{{ strtoupper($trade->direction) }}</span>
                            </td>
                            <td>
                                ₹{{ number_format($trade->entry_price,2) }} / ₹{{ number_format($trade->exit_price,2) }}
                            </td>
                            <td>{{ $trade->quantity }}</td>
                            <td class="{{ $trade->profit_loss>=0?'profit-positive':'profit-negative' }}">
                                {{ $trade->profit_loss>=0?'+':'' }}₹{{ number_format($trade->profit_loss,2) }}
                            </td>
                            <td class="{{ $trade->profit_loss>=0?'profit-positive':'profit-negative' }}">
                                {{ $trade->profit_loss>=0?'+':'' }}{{ number_format($trade->profit_loss_percent,2) }}%
                            </td>
                            <td>{{ gmdate('H\h i\m', $trade->holding_seconds) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<script>
function exportTable() {
    let csv = "Date & Time,Symbol,Direction,Entry,Exit,Qty,P&L,Return %,Holding\n";
    document.querySelectorAll('#basic-1 tbody tr').forEach(row => {
        let cols = row.querySelectorAll('td');
        let rowData = [];
        cols.forEach(td => rowData.push(`"${td.innerText.replace(/\n/g,' ').trim()}"`));
        csv += rowData.join(',') + "\n";
    });
    const blob = new Blob([csv], {type:'text/csv;charset=utf-8;'});
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a'); a.href = url;
    a.download = `trade-history-${new Date().toISOString().slice(0,10)}.csv`;
    a.click(); URL.revokeObjectURL(url);
}

document.getElementById('refreshBtn')?.addEventListener('click', () => location.reload());
</script>
@endsection
