@extends('layout.master')
@section('title', 'Admin - Orders')

@section('main_content')
<div class="container-fluid">
    <h2 class="mb-4">All Orders</h2>
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Challenge</th>
                        <th>Symbol</th>
                        <th>Side</th>
                        <th>Type</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Filled</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->challenge?->plan?->title ?? '—' }}</td>
                        <td><strong>{{ $order->stock_symbol }}</strong></td>
                        <td>{!! $order->side_badge !!}</td>
                        <td><span class="badge bg-secondary">{{ $order->type_text }}</span></td>
                        <td>{{ $order->quantity }}</td>
                        <td>₹{{ number_format($order->price, 2) }}</td>
                        <td>{{ $order->filled_quantity }}/{{ $order->quantity }}</td>
                        <td>{!! $order->status_badge !!}</td>
                        <td>{{ $order->created_at->format('d M H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
