<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Challenge;
use App\Services\DhanService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{


    // Show all orders (with challenge context)
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('challenge')
            ->latest()
            ->paginate(30);

        $activeChallenge = auth()->user()->challenges()->active()->first();

        return view('orders.index', compact('orders', 'activeChallenge'));
    }

    // Place new order
    public function store(Request $request)
    {
        $request->validate([
            'challenge_id' => 'required|exists:challenges,id',
            'symbol'       => 'required|string|min:1|max:20',
            'side'         => 'required|in:BUY,SELL',
            'type'         => 'required|in:LIMIT,MARKET,SL,SL-M',
            'product'      => 'required|in:CNC,INTRADAY,MARGIN,MTF',
            'quantity'     => 'required|integer|min:1',
            'price'        => 'required_if:type,LIMIT,SL,SL-M|numeric|min:0.01',
            'trigger_price' => 'nullable|numeric|min:0.01',
        ]);

        $challenge = Challenge::where('user_id', auth()->id())
            ->active()
            ->findOrFail($request->challenge_id);

        // Map to Dhan payload
        $payload = [
            'transactionType'   => $request->side,
            'exchangeSegment'   => 'NSE_EQ',
            'productType'       => $request->product,
            'orderType'         => $request->type === 'SL-M' ? 'SL-M' : str_replace('-', '', $request->type),
            'validity'          => 'DAY',
            'securityId'        => $this->getSecurityId($request->symbol),
            'quantity'          => (int)$request->quantity,
            'price'            => in_array($request->type, ['MARKET', 'SL-M']) ? 0 : (float)$request->price,
            'triggerPrice'     => in_array($request->type, ['SL', 'SL-M']) ? (float)($request->trigger_price ?? $request->price) : 0,
            'disclosedQuantity' => 0,
            'afterMarketOrder'  => false,
        ];

        $response = $this->dhan->placeOrder($payload);
        $result   = $this->dhan->result($response);

        if (!$result['success']) {
            return back()->with('error', $result['data']['remarks'] ?? 'Order rejected by broker');
        }

        $data = $result['data'];

        Order::create([
            'user_id'         => auth()->id(),
            'challenge_id'    => $challenge->id,
            'stock_symbol'    => strtoupper($request->symbol),
            'security_id'     => $payload['securityId'],
            'order_side'      => $request->side === 'BUY' ? Order::SIDE_BUY : Order::SIDE_SELL,
            'order_type'      => match($request->type) {
                'LIMIT'  => Order::TYPE_LIMIT,
                'MARKET' => Order::TYPE_MARKET,
                'SL'     => Order::TYPE_SL,
                'SL-M'   => Order::TYPE_SL_M,
            },
            'product_type'    => $request->product,
            'price'           => $payload['price'] ?: null,
            'trigger_price'   => $payload['triggerPrice'] ?: null,
            'quantity'        => $request->quantity,
            'status'          => Order::STATUS_OPEN,
            'trx'             => $data['orderId'],
            'correlation_id'  => (string) Str::uuid(),
            'placed_by'       => 'user',
        ]);

        return back()->with('success', "Order placed! → {$data['orderId']}");
    }

    // Cancel order
    public function destroy(Order $order)
    {
        $this->authorize('delete', $order); // or just check user

        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $result = $this->dhan->result($this->dhan->cancelOrder($order->trx));

        if ($result['success']) {
            $order->update(['status' => Order::STATUS_CANCELLED]);
            return back()->with('success', 'Order cancelled successfully');
        }

        return back()->with('error', 'Failed to cancel: ' . ($result['data']['remarks'] ?? 'Unknown'));
    }

    // Sync orders from Dhan (manual or via job)
    public function sync()
    {
        $result = $this->dhan->result($this->dhan->getOrderBook());

        if (!$result['success']) {
            return back()->with('error', 'Sync failed');
        }

        foreach ($result['data'] as $apiOrder) {
            Order::updateOrCreate(
                ['trx' => $apiOrder['orderId']],
                [
                    'user_id'         => auth()->id(),
                    'challenge_id'    => auth()->user()->challenges()->active()->first()?->id,
                    'stock_symbol'    => $apiOrder['tradingSymbol'],
                    'security_id'     => $apiOrder['securityId'],
                    'order_side'      => $apiOrder['transactionType'] === 'BUY' ? 1 : 2,
                    'order_type'      => $this->mapOrderType($apiOrder['orderType']),
                    'product_type'    => $apiOrder['productType'],
                    'price'           => $apiOrder['price'] == 0 ? null : $apiOrder['price'],
                    'trigger_price'   => $apiOrder['triggerPrice'] ?? null,
                    'quantity'        => $apiOrder['quantity'],
                    'filled_quantity' => $apiOrder['tradedQuantity'] ?? 0,
                    'average_price'   => $apiOrder['tradedPrice'] ?? null,
                    'status'          => $this->mapStatus($apiOrder['orderStatus']),
                ]
            );
        }

        return back()->with('success', 'Orders synced from Dhan!');
    }

    private function mapOrderType(string $type): int
    {
        return match($type) {
            'LIMIT'  => Order::TYPE_LIMIT,
            'MARKET' => Order::TYPE_MARKET,
            'SL'     => Order::TYPE_SL,
            'SL-M'   => Order::TYPE_SL_M,
            default   => Order::TYPE_LIMIT,
        };
    }

    private function mapStatus(string $status): int
    {
        return match($status) {
            'PENDING', 'OPEN'       => Order::STATUS_OPEN,
            'TRADED', 'COMPLETE'    => Order::STATUS_COMPLETED,
            'PARTIALLY_FILLED'      => Order::STATUS_PARTIAL,
            'CANCELLED', 'REJECTED' => Order::STATUS_CANCELLED,
            default                 => Order::STATUS_OPEN,
        };
    }

    private function getSecurityId(string $symbol): string
    {
        // Replace with real mapping or Redis cache
        $map = [
            'RELIANCE' => '1333',
            'TCS'      => '11536',
            'INFY'     => '1594',
            'HDFCBANK' => '1330',
            'SBIN'     => '3045',
        ];

        return $map[strtoupper($symbol)] ?? '1333'; // fallback
    }
}
