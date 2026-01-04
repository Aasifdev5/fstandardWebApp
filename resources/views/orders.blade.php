@extends('user-master')

@section('title', 'Orders')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">


        </div>

        @if ($orders->isEmpty())
            <div class="card bg-dark border-0 shadow-sm text-center p-5">
                <i class="fas fa-receipt fa-4x text-muted mb-4"></i>
                <h4 class="text-white">No orders yet</h4>
                <p class="text-muted mb-0">Your placed orders will appear here automatically.</p>
            </div>
        @else
            <div class="card bg-dark border-0 shadow">
                <div class="card-header">
                    <h2 class="text-white mb-0">
                        <i class="fas fa-shopping-cart me-2"></i> Orders
                    </h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-1" class="table table-dark table-hover mb-0">
                            <thead class="table-borderless">
                                <tr>
                                    <th>Time</th>
                                    <th>Symbol</th>
                                    <th>Side</th>
                                    <th>Type</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Filled</th>
                                    <th>Status</th>
                                    <th>PL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="text-light small">
                                            {{ $order->created_at->format('d M, H:i') }}
                                        </td>
                                        <td>
                                            <strong>{{ $order->stock_symbol }}</strong>
                                        </td>
                                        <td>{!! $order->side_badge !!}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $order->type_text }}</span>
                                        </td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>
                                            @if ($order->price > 0)
                                                ₹{{ number_format($order->price, 2) }}
                                            @else
                                                <em class="text-muted">Market</em>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar {{ $order->filled_quantity == $order->quantity ? 'bg-success' : 'bg-warning' }}"
                                                    role="progressbar" style="width: {{ $order->filled_percentage }}%"
                                                    aria-valuenow="{{ $order->filled_percentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $order->filled_percentage }}%
                                                </div>
                                            </div>
                                        </td>
                                        <td>{!! $order->status_badge !!}</td>
                                        <td>{{ $order->close_reason }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>
        @endif
    </div>
@endsection
