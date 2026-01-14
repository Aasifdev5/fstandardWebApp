@extends('layout.master')
@section('title', 'Admin - Order History')

@section('main_content')
<div class="container-fluid py-4">
    <h2 class=" mb-4">Order History</h2>

    <div class="card  border-0 shadow">
        <div class="card-body">
<div class="table-responsive">
            <table id="basic-1" class="table table-dark table-hover mb-0">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Challenge</th>
                        <th>Symbol</th>
                        <th>Side</th>
                        <th>Type</th>
                        <th>Qty</th>
                        <th>Avg Price</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->user->name }}</td>
                        <td><small>{{ $order->challenge?->plan?->title ?? '—' }}</small></td>
                        <td><strong>{{ $order->stock_symbol }}</strong></td>
                        <td>{!! $order->side_badge !!}</td>
                        <td><span class="badge bg-secondary">{{ $order->type_text }}</span></td>
                        <td>{{ $order->quantity }}</td>
                        <td>₹{{ number_format($order->average_price ?: 0, 2) }}</td>
                        <td>₹{{ number_format($order->total_amount ?: 0, 2) }}</td>
                        <td>{!! $order->status_badge !!}</td>
                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-5">
                            <i class="fas fa-history fa-3x mb-3"></i><br>
                            No completed or canceled orders
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div>

    </div>
</div>
@endsection
