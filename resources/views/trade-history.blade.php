@extends('user-master')
@section('title', 'Trade History')

@push('styles')
    <style>
        .win-rate {
            font-size: 48px;
            font-weight: 900;
            background: linear-gradient(90deg, #22c55e, #16a34a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .loss-rate {
            background: linear-gradient(90deg, #ef4444, #dc2626);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .trade-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 16px;
            border: 1px solid #334155;
            transition: all 0.3s;
        }

        .trade-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            border-color: #f59e0b;
        }

        .profit-positive {
            color: #22c55e;
        }

        .profit-negative {
            color: #ef4444;
        }

        .badge-long {
            background: #22c55e;
        }

        .badge-short {
            background: #ef4444;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="text-white fw-bold">
                <i class="fas fa-history me-3"></i> Trade History
            </h2>
            <button class="btn btn-outline-light btn-sm" onclick="exportTable()">
                <i class="fas fa-download"></i> Export CSV
            </button>
        </div>

        @if ($trades->isEmpty())
            <div class="card bg-dark border-0 text-center p-5">
                <i class="fas fa-history fa-5x text-muted mb-4"></i>
                <h4 class="text-white">No trades yet</h4>
                <p class="text-muted">Your closed trades will appear here automatically.</p>
            </div>
        @else
            <!-- Win Rate & Stats -->
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="text-center p-4 rounded-3 bg-dark border border-secondary">
                        <div class="fs-1 fw-bold win-rate">{{ $winRate }}%</div>
                        <div class="text-muted small">Win Rate</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center p-4 rounded-3 bg-dark border border-secondary">
                        <div class="fs-1 fw-bold text-warning">{{ $totalTrades }}</div>
                        <div class="text-muted small">Total Trades</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center p-4 rounded-3 bg-dark border border-secondary">
                        <div class="fs-1 fw-bold text-success">+₹{{ number_format($netProfit, 2) }}</div>
                        <div class="text-muted small">Net P&L</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center p-4 rounded-3 bg-dark border border-secondary">
                        <div class="fs-1 fw-bold text-info">{{ $avgHolding }}</div>
                        <div class="text-muted small">Avg Holding</div>
                    </div>
                </div>
            </div>

            <!-- Trades Table -->
            <div class="card bg-dark border-0 shadow-lg">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0" id="tradesTable">
                        <thead class="border-bottom border-secondary">
                            <tr>
                                <th>Date</th>
                                <th>Symbol</th>
                                <th>Direction</th>
                                <th>Entry</th>
                                <th>Exit</th>
                                <th>Qty</th>
                                <th>P&L</th>
                                <th>%</th>
                                <th>Holding</th>
                                <th>Setup</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trades as $trade)
                                <tr class="trade-card">
                                    <td class="text-light small">
                                        {{ $trade->exit_time->format('d M') }}<br>
                                        <small>{{ $trade->exit_time->format('H:i') }}</small>
                                    </td>
                                    <td><strong>{{ $trade->symbol }}</strong></td>
                                    <td>
                                        <span
                                            class="badge {{ $trade->direction === 'long' ? 'badge-long' : 'badge-short' }} px-3 py-2">
                                            {{ strtoupper($trade->direction) }}
                                        </span>
                                    </td>
                                    <td>₹{{ number_format($trade->entry_price, 2) }}</td>
                                    <td>₹{{ number_format($trade->exit_price, 2) }}</td>
                                    <td>{{ $trade->quantity }}</td>
                                    <td
                                        class="{{ $trade->profit_loss >= 0 ? 'profit-positive' : 'profit-negative' }} fw-bold">
                                        {{ $trade->profit_loss >= 0 ? '+' : '' }}₹{{ number_format(abs($trade->profit_loss), 2) }}
                                    </td>
                                    <td class="{{ $trade->profit_loss >= 0 ? 'profit-positive' : 'profit-negative' }}">
                                        {{ $trade->profit_loss >= 0 ? '+' : '' }}{{ number_format($trade->profit_loss_percent, 2) }}%
                                    </td>
                                    <td class="small">{{ gmdate('H\hi m\mi\ss\s', $trade->holding_seconds) }}</td>
                                    <td>
                                        @if ($trade->meta && (isset($trade->meta['setup']) || isset($trade->meta['note'])))
                                            <span class="badge bg-secondary">
                                                {{ $trade->meta['setup'] ?? $trade->meta['note'] }}
                                            </span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    <script>
        function exportTable() {
            let data = "Date,Symbol,Direction,Entry,Exit,Qty,P&L,%,Holding,Setup\n";
            document.querySelectorAll('#tradesTable tbody tr').forEach(row => {
                const cols = row.querySelectorAll('td');
                data += Array.from(cols).map(td => td.innerText.trim()).join(',') + "\n";
            });

            const blob = new Blob([data], {
                type: 'text/csv'
            });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'trade-history-' + new Date().toISOString().slice(0, 10) + '.csv';
            a.click();
        }
    </script>
@endsection
