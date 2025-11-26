<div class="wishlist-layout">
    @include('trading.partials._wishlist-sidebar')

    <div class="chart-area">
        <div class="chart-topbar">
            <div class="fw-600">RELIANCE</div>
            <div class="mono text-green fw-600">2,845.50</div>
            <div class="text-muted mono" style="font-size:11px;">+1.25%</div>
            <div style="border-left:1px solid var(--border-subtle);height:20px;margin:0 10px;"></div>
            <div class="flex-center" style="gap:10px;">
                <button class="sub-link active" style="background:none;border:none;">5m</button>
                <button class="sub-link" style="background:none;border:none;">15m</button>
                <button class="sub-link" style="background:none;border:none;">1H</button>
                <i class="fa-solid fa-chart-bar text-blue"></i>
                <i class="fa-solid fa-bolt text-muted"></i>
            </div>
        </div>

        <div class="chart-wrapper">
            <div class="floating-trade">
                <button class="trade-btn trade-buy"><span style="font-size:9px;opacity:0.8;">BUY</span><span class="mono fw-600">2845.55</span></button>
                <button class="trade-btn trade-sell"><span style="font-size:9px;opacity:0.8;">SELL</span><span class="mono fw-600">2845.45</span></button>
            </div>
            <div id="tv-chart" class="tv-chart-container"></div>
        </div>
    </div>
</div>
