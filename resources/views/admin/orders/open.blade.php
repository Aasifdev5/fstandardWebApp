@extends('layout.master')
@section('title', 'Admin - Open Orders')

@section('main_content')
<div class="container-fluid py-4">
    <h2 class="text-white mb-4">Open Orders</h2>

<div class="card bg-dark border-0 shadow">
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0">
            <thead class="border-bottom border-secondary">
                <tr>
                    <th>User</th>
                    <th>Challenge</th>
                    <th>Symbol</th>
                    <th>Side</th>
                    <th>Type</th>
                    <th>Qty / Filled</th>
                    <th>Price</th>
                    <th>Progress</th>
                    <th>Placed</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="text-white">{{ $order->user->name }}</td>
                    <td><small class="text-muted">{{ $order->challenge?->plan?->title ?? '—' }}</small></td>
                    <td><strong>{{ $order->stock_symbol }}</strong></td>
                    <td>{!! $order->side_badge !!}</td>
                    <td><span class="badge bg-secondary">{{ $order->type_text }}</span></td>
                    <td>{{ $order->filled_quantity }} / {{ $order->quantity }}</td>
                    <td>₹{{ number_format($order->price ?: 0, 2) }}</td>
                    <td>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar {{ $order->status == 2 ? 'bg-warning' : 'bg-info' }}"
                                 style="width: {{ $order->filled_percentage }}%"></div>
                        </div>
                        <small>{{ $order->filled_percentage }}%</small>
                    </td>
                    <td class="text-muted small">{{ $order->created_at->diffForHumans() }}</td>
                    <td>
                        @if($order->status == 0)
                            <form action="{{ route('orders.cancel', $order) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Cancel this order?')">
                                    Cancel
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted py-5">
                        <i class="fas fa-check-circle fa-3x mb-3"></i><br>
                        No open orders at the moment
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
