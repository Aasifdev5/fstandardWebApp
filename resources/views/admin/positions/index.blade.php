@extends('layout.master')
@section('title', 'Admin - Live Positions')

@section('main_content')
    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white mb-0">Live Positions</h2>
            <button class="btn btn-outline-info btn-sm" onclick="location.reload()">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>

        @if ($positions->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="fas fa-chart-line fa-4x mb-3"></i>
                <h5>No open positions</h5>
            </div>
        @else
            <div class="card  border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-1" class="table table-dark table-hover align-middle mb-0">
                            <thead class="table-secondary text-dark">
                                <tr>
                                    <th>Symbol</th>
                                    <th>Side</th>
                                    <th>Lot Type</th>
                                    <th class="text-end">Qty</th>
                                    <th class="text-end">Entry Price</th>
                                    <th class="text-end">P&amp;L</th>
                                    <th>Entry Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($positions as $pos)
                                    <tr>
                                        {{-- Symbol --}}
                                        <td class="fw-semibold">
                                            {{ $pos->symbol }}
                                        </td>

                                        {{-- Side --}}
                                        <td>
                                            <span class="badge {{ $pos->side === 'BUY' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $pos->side }}
                                            </span>
                                        </td>

                                        {{-- Lot Type --}}
                                        <td>
                                            <span class="badge bg-info text-dark">
                                                {{ strtoupper($pos->lot_type) }}
                                            </span>
                                        </td>

                                        {{-- Quantity --}}
                                        <td class="text-end {{ $pos->qty > 0 ? 'text-success' : 'text-danger' }}">
                                            {{ number_format($pos->qty, 2) }}
                                        </td>

                                        {{-- Entry Price --}}
                                        <td class="text-end">
                                            ₹{{ number_format($pos->entry_price, 2) }}
                                        </td>

                                        {{-- P&L --}}
                                        <td class="text-end {{ $pos->pnl >= 0 ? 'text-success' : 'text-danger' }}">
                                            {{ $pos->pnl >= 0 ? '+' : '' }}₹{{ number_format(abs($pos->pnl), 2) }}
                                        </td>

                                        {{-- Entry Time --}}
                                        <td class="text-muted">
                                            {{ optional($pos->entry_time)->format('d M Y, H:i') }}
                                        </td>
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
