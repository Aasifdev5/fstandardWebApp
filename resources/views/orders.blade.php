@extends('user-master')

@section('title', 'Orders')

@push('styles')
    <style>
        .orders-card {
            background: linear-gradient(135deg, #0f172a, #020617);
            border-radius: 18px;
            border: 1px solid #1e293b;
        }

        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 26px;
            border-bottom: 1px solid #1e293b;
        }

        .orders-header h2 {
            margin: 0;
            font-weight: 700;
        }

        .orders-table th {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94a3b8;
            border-bottom: 1px solid #1e293b !important;
        }

        .orders-table td {
            vertical-align: middle;
            border-top: 1px solid #1e293b;
        }

        .orders-table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.03);
        }

        .symbol-pill {
            font-weight: 700;
            letter-spacing: 0.4px;
        }

        .price-text {
            font-weight: 600;
        }

        .empty-state {
            background: linear-gradient(135deg, #020617, #020617);
            border-radius: 20px;
            padding: 70px 20px;
            border: 1px dashed #334155;
            text-align: center;
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            color: #64748b;
        }

        .empty-state h4 {
            font-weight: 700;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: #94a3b8;
            margin-bottom: 0;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-white fw-bold mb-0">
                <i class="fas fa-shopping-cart me-2 text-primary"></i> Orders
            </h1>
            <span class="badge bg-secondary px-3 py-2">
                {{ $orders->count() }} Total
            </span>
        </div>

        {{-- Empty State --}}
        @if ($orders->isEmpty())
            <div class="empty-state">
                <i class="fas fa-receipt"></i>
                <h4 class="text-white">No orders placed yet</h4>
                <p>Your trading activity will appear here once you place an order.</p>
            </div>
        @else
            {{-- Orders Table --}}
            <div class="card shadow-lg">
                <div class="card-header">
                    <h2 class="text-white">
                        <i class="fas fa-list me-2 text-warning"></i> Order History
                    </h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-1" class="table table-dark table-hover mb-0 orders-table">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Symbol</th>
                                    <th>Side</th>
                                    <th>Type</th>
                                    <th>Qty</th>
                                    <th>Avg Price</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="text-light small">
                                            {{ $order->created_at->format('d M Y') }}<br>
                                            {{ $order->created_at->format('H:i') }}
                                        </td>

                                        <td>
                                            <span class="symbol-pill text-white">
                                                {{ $order->stock_symbol }}
                                            </span>
                                        </td>

                                        <td>{!! $order->side_badge !!}</td>

                                        <td>
                                            <span class="badge bg-secondary">
                                                {{ $order->type_text }}
                                            </span>
                                        </td>

                                        <td>{{ number_format($order->quantity) }}</td>

                                        <td class="price-text">
                                            ₹{{ number_format($order->average_price ?? 0, 2) }}
                                        </td>

                                        <td class="price-text">
                                            ₹{{ number_format($order->total_amount ?? 0, 2) }}
                                        </td>

                                        <td>{!! $order->status_badge !!}</td>
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
