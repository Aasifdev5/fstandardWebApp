{{-- resources/views/trading/partials/_fo-watchlist.blade.php --}}
<div id="tab-index-fo" class="market-tab section">
    <div class="panel-header" style="border:none; padding-left:0; margin-bottom:20px;">
        F&O Watchlist
    </div>

    <div class="panel" style="padding:20px; display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <div>
            <div class="text-muted" style="font-size:12px;">Nearest SENSEX Future</div>
            <div class="flex-center" style="gap:10px; margin-top:5px;">
                <span class="fw-600">SENSEX 27 Nov 2025</span>
                <span class="mono text-green fw-600">₹85,520.00 +0.32%</span>
            </div>
        </div>
        <div class="text-blue" style="cursor:pointer;">
            Charts &nbsp;|&nbsp; Option Chain
        </div>
    </div>

    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <!-- Call Options -->
        <div class="panel">
            <div class="panel-header" style="border-left:4px solid #9c27b0;">
                Call Options
            </div>
            <table class="table-dark">
                <tr><td>SENSEX 85200 <span class="tag tag-itm">ITM</span></td><td class="text-green mono text-right">₹292.00</td></tr>
                <tr><td>SENSEX 85300 <span class="tag tag-itm">ITM</span></td><td class="text-green mono text-right">₹215.05</td></tr>
                <tr><td>SENSEX 85400 <span class="tag tag-itm">ATM</span></td><td class="text-green mono text-right">₹150.20</td></tr>
            </table>
        </div>

        <!-- Put Options -->
        <div class="panel">
            <div class="panel-header" style="border-left:4px solid #d68330;">
                Put Options
            </div>
            <table class="table-dark">
                <tr><td>SENSEX 85600 <span class="tag tag-itm">ITM</span></td><td class="text-red mono text-right">₹211.50</td></tr>
                <tr><td>SENSEX 85500 <span class="tag tag-itm">ITM</span></td><td class="text-red mono text-right">₹149.00</td></tr>
                <tr><td>SENSEX 85400 <span class="tag tag-itm">ATM</span></td><td class="text-red mono text-right">₹98.10</td></tr>
            </table>
        </div>
    </div>
</div>
