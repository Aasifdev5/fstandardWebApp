{{-- resources/views/trading/dashboard.blade.php --}}
@extends('trading-master')

@section('title', 'Trading')

@push('styles')
<style>
    :root {
        --bg-app: #0b0e11;
        --bg-panel: #15181c;
        --bg-hover: #1e2229;
        --border-subtle: #25282f;
        --text-primary: #f2f2f2;
        --text-secondary: #9ea4ac;
        --text-dim: #676e78;
        --green: #26a69a;
        --green-bg: rgba(38,166,154,0.15);
        --red: #ef5350;
        --red-bg: rgba(239,83,80,0.15);
        --blue: #3b82f6;
        --blue-accent: #2962ff;
        --font-main: 'Inter', sans-serif;
        --font-num: 'JetBrains Mono', monospace;
    }

    * { box-sizing:border-box; outline:none; -webkit-font-smoothing:antialiased; }
    body { margin:0; background:var(--bg-app); color:var(--text-primary); font-family:var(--font-main); font-size:13px; overflow:hidden; height:100vh; display:flex; flex-direction:column; }

    /* ← Paste ALL your original 300+ lines of CSS below this line → */
    .mono { font-family:var(--font-num); font-variant-numeric:tabular-nums; }
    .text-green { color:var(--green); }
    .text-red { color:var(--red); }
    .text-blue { color:var(--blue); cursor:pointer; }
    .text-muted { color:var(--text-secondary); }
    .fw-600 { font-weight:600; }
    .flex-center { display:flex; align-items:center; }
    .flex-between { display:flex; justify-content:space-between; align-items:center; }

    /* Top Navigation */
    .top-nav { height:60px; background:var(--bg-app); border-bottom:1px solid var(--border-subtle); padding:0 24px; flex-shrink:0; z-index:100; }
    /* ... continue with ALL your existing CSS classes exactly as before ... */

    .page { display:none; width:100%; height:100%; overflow-y:auto; padding:20px 24px; }
    .page.active { display:block; }
    #page-wishlist.active { display:flex; padding:0; overflow:hidden; }
    .section { display:none; }
    .section.active { display:block; }
</style>
@endpush

@section('content')
    @include('trading.partials._top-nav')

    <div class="main-container">
        <div id="page-markets" class="page active">
            @include('trading.partials._ticker-strip')
            @include('trading.partials._discovery-panel')
            @include('trading.partials._fo-watchlist')
            @include('trading.partials._sector-heatmap')
        </div>

        <div id="page-wishlist" class="page">
            @include('trading.partials._wishlist-layout')
        </div>

        <div id="page-orders" class="page">
            <h2 class="fw-600" style="padding:0 24px 16px;">Orders</h2>
            @include('trading.partials._orders-table')
        </div>

        <div id="page-holdings" class="page">
            <h2 class="fw-600" style="padding:0 24px 16px;">Holdings</h2>
            @include('trading.partials._holdings-table')
        </div>

        <div id="page-positions" class="page">
            <h2 class="fw-600" style="padding:0 24px 16px;">Positions</h2>
            @include('trading.partials._positions-table')
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
<script>
    let tvChart, candleSeries;

    window.switchPage = function(pageId, el) {
        document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
        el.classList.add('active');
        document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
        document.getElementById('page-' + pageId).classList.add('active');
        if (pageId === 'wishlist' && tvChart) tvChart.resize();
    };

    window.switchMarketTab = function(tabId, el) {
        document.querySelectorAll('.sub-link').forEach(l => l.classList.remove('active'));
        el.classList.add('active');
        document.querySelectorAll('.market-tab').forEach(t => t.classList.remove('active'));
        document.getElementById('tab-' + tabId).classList.add('active');
    };

    document.addEventListener('DOMContentLoaded', () => {
        // ApexCharts
        const areaEl = document.getElementById('marketAreaChart');
        if (areaEl) {
            new ApexCharts(areaEl, {
                series: [{ name:'Price', data:[85350,85320,85360,85340,85280,85295,85330,85390,85440,85429] }],
                chart: { type:'area', height:300, toolbar:{show:false}, background:'transparent' },
                colors:['#26a69a'], fill:{type:'gradient', gradient:{opacityFrom:0.4, opacityTo:0.05}},
                stroke:{width:2}, grid:{borderColor:'#25282f'},
                xaxis:{labels:{style:{colors:'#9ea4ac'}}, axisBorder:{show:false}},
                yaxis:{opposite:true, labels:{style:{colors:'#9ea4ac'}}},
                theme:{mode:'dark'}
            }).render();
        }

        // Lightweight Chart
        if (document.getElementById('page-wishlist').classList.contains('active')) {
            initTVChart();
        }
    });

    function initTVChart() {
        const container = document.getElementById('tv-chart');
        if (!container || tvChart) return;

        tvChart = LightweightCharts.createChart(container, {
            layout:{background:{color:'transparent'}, textColor:'#9ea4ac'},
            grid:{vertLines:{color:'#25282f'}, horzLines:{color:'#25282f'}},
            rightPriceScale:{borderColor:'#25282f'}, timeScale:{borderColor:'#25282f'}
        });

        candleSeries = tvChart.addCandlestickSeries({
            upColor:'#26a69a', downColor:'#ef5350',
            borderUpColor:'#26a69a', wickUpColor:'#26a69a',
            borderDownColor:'#ef5350', wickDownColor:'#ef5350'
        });

        const data = Array.from({length:120}, (_,i) => {
            const time = Math.floor(Date.now()/1000) - (120-i)*300;
            const open = 2840 + Math.sin(i/10)*20;
            const close = open + (Math.random()-0.5)*10;
            return {time, open, high:Math.max(open,close)+5, low:Math.min(open,close)-5, close};
        });
        candleSeries.setData(data);

        new ResizeObserver(() => tvChart.resize()).observe(container);
    }

    // Live price animation
    setInterval(() => {
        document.querySelectorAll('.live-price').forEach(el => {
            const base = parseFloat(el.dataset.base);
            const change = (Math.random() - 0.5) * 2.5;
            const newPrice = (base + change).toFixed(2);
            el.textContent = newPrice;
            el.classList.toggle('text-green', change >= 0);
            el.classList.toggle('text-red', change < 0);
        });
    }, 1300);
</script>
@endpush
