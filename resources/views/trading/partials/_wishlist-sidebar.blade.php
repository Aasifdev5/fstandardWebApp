<div class="wl-sidebar">
    <div class="wl-header-box">
        <div class="flex-between fw-600" style="margin-bottom:10px;">
            <span>Wishlist 1</span>
            <i class="fa-solid fa-gear text-muted"></i>
        </div>
        <input type="text" class="search-input" placeholder="Search scrip...">
    </div>
    <div class="wl-items-container" id="wishlist-container">
        @php
            $scrips = [
                ['s' => 'RELIANCE', 'p' => 2845.50, 'c' => 1.2],
                ['s' => 'HDFCBANK', 'p' => 1650.20, 'c' => -0.5],
                ['s' => 'INFY',     'p' => 1420.00, 'c' => 0.8],
                ['s' => 'TATASTEEL','p' => 155.00,  'c' => -0.2],
                ['s' => 'ADANIENT', 'p' => 3100.50, 'c' => 2.1],
            ];
        @endphp
        @foreach($scrips as $i => $sc)
            <div class="wl-item {{ $i===0 ? 'active' : '' }}">
                <div>
                    <div class="fw-600">{{ $sc['s'] }}</div>
                    <div class="text-muted" style="font-size:10px;">NSE</div>
                </div>
                <div style="text-align:right;">
                    <div class="mono live-price" data-base="{{ $sc['p'] }}">{{ number_format($sc['p'], 2) }}</div>
                    <div class="mono {{ $sc['c'] >= 0 ? 'text-green' : 'text-red' }}" style="font-size:11px;">
                        {{ $sc['c'] > 0 ? '+' : '' }}{{ $sc['c'] }}%
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
