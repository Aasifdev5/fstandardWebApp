<nav class="top-nav flex-center">
    <div style="display:flex;align-items:center;font-size:18px;font-weight:700;">
        <i class="fa-solid fa-infinity" style="color:var(--blue);margin-right:10px;"></i>
        <span>F Standard</span>
    </div>

    <div class="main-menu flex-center">
        <div class="menu-item active" onclick="switchPage('markets', this)">Markets</div>
        <div class="menu-item" onclick="switchPage('wishlist', this)">Wishlist</div>
        <div class="menu-item" onclick="switchPage('orders', this)">Orders</div>
        <div class="menu-item" onclick="switchPage('holdings', this)">Holdings</div>
        <div class="menu-item" onclick="switchPage('positions', this)">
            Positions <span style="background:var(--red);color:white;padding:1px 5px;border-radius:4px;font-size:10px;margin-left:5px;">2</span>
        </div>
        <div class="menu-item" onclick="switchPage('funds', this)">Funds</div>
    </div>

    <div style="margin-left:auto;display:flex;gap:20px;align-items:center;">
        <div style="text-align:right;">
            <div style="font-size:11px;color:var(--text-secondary);">NIFTY</div>
            <div class="mono text-green">26,137.95</div>
        </div>
        <div style="width:32px;height:32px;background:var(--blue-accent);color:white;border-radius:50%;display:grid;place-items:center;font-weight:600;">
            {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 2)) : 'JD' }}
        </div>
    </div>
</nav>
