{{-- resources/views/trading/partials/_orders-table.blade.php --}}
<div class="panel" style="margin: 0 24px;">
    <table class="table-dark">
        <thead>
            <tr>
                <th>Time</th>
                <th>Type</th>
                <th>Instrument</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="mono">14:28:12</td>
                <td><span class="text-green fw-600">BUY</span></td>
                <td>RELIANCE</td>
                <td class="mono text-right">25</td>
                <td class="mono text-right">2,845.00</td>
                <td><span class="text-green">COMPLETE</span></td>
            </tr>
            <tr>
                <td class="mono">13:55:40</td>
                <td><span class="text-red fw-600">SELL</span></td>
                <td>TATASTEEL</td>
                <td class="mono text-right">100</td>
                <td class="mono text-right">155.00</td>
                <td><span class="text-green">COMPLETE</span></td>
            </tr>
            <tr>
                <td class="mono">12:18:05</td>
                <td><span class="text-green fw-600">BUY</span></td>
                <td>HDFCBANK</td>
                <td class="mono text-right">50</td>
                <td class="mono text-right">1,650.20</td>
                <td><span style="color:#ffb74d;">PENDING</span></td>
            </tr>
            <tr>
                <td class="mono">10:30:45</td>
                <td><span class="text-green fw-600">BUY</span></td>
                <td>ITC</td>
                <td class="mono text-right">200</td>
                <td class="mono text-right">435.50</td>
                <td><span class="text-green">COMPLETE</span></td>
            </tr>
        </tbody>
    </table>
</div>
