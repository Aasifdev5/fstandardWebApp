@extends('user-master')
@section('title', 'Dashboard')

@push('styles')
<style>

    .metric-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:20px; margin-bottom:40px; }
    .metric-card { background:#1e2530; border-radius:16px; padding:24px; text-align:center; border:1px solid #2d3748; transition:all .3s; }
    .metric-card:hover { transform:translateY(-8px); box-shadow:0 10px 30px rgba(0,0,0,0.4); border-color:#ff8c00; }
    .metric-icon { width:60px; height:60px; margin:0 auto 16px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:28px; }
    .metric-value { font-size:36px; font-weight:700; margin:10px 0; color:#fff; }
    .metric-label { color:#a0aec0; font-size:14px; text-transform:uppercase; letter-spacing:1px; }
    .status-open .metric-icon      { background:rgba(59,130,246,0.2); color:#3b82f6; }
    .status-completed .metric-icon { background:rgba(34,197,94,0.2); color:#22c55e; }
    .status-canceled .metric-icon  { background:rgba(239,68,68,0.2); color:#ef4444; }
    .status-total .metric-icon     { background:rgba(99,102,241,0.2); color:#6366f1; }
    .section-title { font-size:20px; font-weight:600; margin-bottom:20px; color:#fff; }
    .empty-state { text-align:center; padding:60px 20px; background:#1e2530; border-radius:16px; border:1px dashed #2d3748; }
    .empty-state i { font-size:64px; color:#4a5568; margin-bottom:20px; }
    .empty-text { color:#a0aec0; font-size:16px; }
</style>
@endpush

@section('content')
<h2 class="mb-4 text-white fw-bold">Welcome {{ $user_session->name }}</h2>



<div class="metric-grid">
    <div class="metric-card status-open"><div class="metric-icon"><i class="fa-solid fa-clock"></i></div><div class="metric-label">Open Order</div><div class="metric-value">0</div></div>
    <div class="metric-card status-completed"><div class="metric-icon"><i class="fa-solid fa-check-circle"></i></div><div class="metric-label">Completed Order</div><div class="metric-value">0</div></div>
    <div class="metric-card status-canceled"><div class="metric-icon"><i class="fa-solid fa-times-circle"></i></div><div class="metric-label">Canceled Order</div><div class="metric-value">0</div></div>
    <div class="metric-card status-total"><div class="metric-icon"><i class="fa-solid fa-chart-line"></i></div><div class="metric-label">Total Trade</div><div class="metric-value">0</div></div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <h3 class="section-title">Recent Order</h3>
        <div class="empty-state"><i class="fa-solid fa-box-open"></i><div class="empty-text">No order found</div></div>
    </div>
    <div class="col-lg-6">
        <h3 class="section-title">Recent Transactions</h3>
        <div class="empty-state"><i class="fa-solid fa-receipt"></i><div class="empty-text">No transactions found</div></div>
    </div>
</div>
@endsection
