@extends('layout.master')
@section('title', 'Admin - Position History')

@section('main_content')
<div class="container-fluid py-4">
    <h2 class="text-white mb-4">Closed Positions History</h2>

    <div class="card bg-dark border-0 shadow">
        <div class="table-responsive">
            <table class="table table-dark table-hover mb-0">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Challenge</th>
                        <th>Symbol</th>
                        <th>Direction</th>
                        <th>Entry</th>
                        <th>Exit</th>
                        <th>Qty</th>
                        <th>P&L</th>
                        <th>Holding</th>
                        <th>Closed At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($trades as $trade)
                    <tr>
                        <td>{{ $trade->user->name }}</td>
                        <td><small>{{ $trade->challenge?->plan?->title ?? '—' }}</small></td>
                        <td><strong>{{ $trade->symbol }}</strong></td>
                        <td><span class="badge {{ $trade->direction === 'long' ? 'bg-success' : 'bg-danger' }}">{{ strtoupper($trade->direction) }}</span></td>
                        <td>₹{{ number_format($trade->entry_price, 2) }}</td>
                        <td>₹{{ number_format($trade->exit_price, 2) }}</td>
                        <td>{{ $trade->quantity }}</td>
                        <td class="{{ $trade->profit_loss >= 0 ? 'text-success' : 'text-danger' }} fw-bold">
                            {{ $trade->profit_loss >= 0 ? '+' : '' }}₹{{ number_format(abs($trade->profit_loss), 2) }}
                        </td>
                        <td>{{ gmdate('H\hi m\mi\ss\s', $trade->holding_seconds) }}</td>
                        <td>{{ $trade->exit_time->format('d M Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-5">
                            <i class="fas fa-archive fa-3x mb-3"></i><br>
                            No closed positions
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
