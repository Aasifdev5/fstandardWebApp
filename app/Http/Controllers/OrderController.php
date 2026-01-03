<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Trade;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function place(Request $request)
    {
        $request->validate([
            'symbol'    => 'required|string',
            'side'      => 'required|in:BUY,SELL',
            'quantity'  => 'required|integer|min:1',
            'lot_type'  => 'required|in:micro,mini,standard,large,mega',
            'type'      => 'required|in:MARKET,LIMIT,SL-LIMIT,SL-MARKET',
            'price'     => 'numeric',
            'user_id'   => 'sometimes|integer',
        ]);

        // 1. Resolve User
        $user = Auth::user();
        if (!$user) {
            if (Session::has('LoggedIn')) {
                $user = User::find(Session::get('LoggedIn'));
            } elseif ($request->has('user_id')) {
                $user = User::find($request->user_id);
            }
        }

        if (!$user) {
            return response()->json(['message' => 'Unauthorized user.'], 401);
        }

        // 2. Check Mega Lot Permission
        if ($request->lot_type === 'mega' && !$user->can_trade_mega) {
            return response()->json(['message' => 'Mega lot is locked. You need more profitable trades.'], 403);
        }

        // 3. Map Request Data to DB Constants
        // Frontend sends 'BUY', DB needs 1. Frontend sends 'MARKET', DB needs 2.
        $sideMap = [
            'BUY'  => Order::SIDE_BUY,  // 1
            'SELL' => Order::SIDE_SELL, // 2
        ];

        $typeMap = [
            'LIMIT'     => Order::TYPE_LIMIT,  // 1
            'MARKET'    => Order::TYPE_MARKET, // 2
            'SL-LIMIT'  => Order::TYPE_SL,     // 3
            'SL-MARKET' => Order::TYPE_SL_M,   // 4
        ];

        // 4. Create Order (Fixing Column Names)
        $order = Order::create([
            'user_id'       => $user->id,
            'lot_type'      => $request->lot_type,

            // --- FIX: Map 'symbol' to 'stock_symbol' ---
            'stock_symbol'  => $request->symbol,
            'security_id'   => '0000', // Default if you don't have this yet

            // --- FIX: Map string side/type to integers ---
            'order_side'    => $sideMap[$request->side],
            'order_type'    => $typeMap[$request->type],

            'quantity'      => $request->quantity,
            'filled_quantity' => 0, // Initialize
            'price'         => $request->price,
            'trigger_price' => $request->trigger_price,
            'product_type'  => $request->product ?? 'MIS',
            'status'        => Order::STATUS_OPEN, // 0
        ]);

        // 5. IMMEDIATE EXECUTION (Simplified for MARKET orders)
        if ($request->type === 'MARKET') {
            $trade = Trade::create([
                'user_id'     => $user->id,
                'order_id'    => $order->id,

                // Trade model uses 'symbol' and string 'side' (based on your snippet)
                'symbol'      => $request->symbol,
                'side'        => $request->side,
                'lot_type'    => $request->lot_type,
                'qty'         => $request->quantity,
                'entry_price' => $request->price,
                'status'      => 'OPEN',
                'entry_time'  => now(),
            ]);

            // Update Order to Completed
            $order->update([
                'status' => Order::STATUS_COMPLETED,
                'filled_quantity' => $request->quantity,
                'average_price' => $request->price
            ]);

            return response()->json(['message' => 'Order executed', 'trade_id' => $trade->id]);
        }

        return response()->json(['message' => 'Order placed', 'order_id' => $order->id]);
    }
}
