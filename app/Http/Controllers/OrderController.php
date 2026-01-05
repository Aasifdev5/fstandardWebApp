<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Trade;
use App\Models\User;
use App\Models\Instrument;
use App\Models\Challenge; // ✅ Import Challenge
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function place(Request $request)
    {
        // 1️⃣ Validate input
        $request->validate([
            'symbol'        => 'required|string',
            'side'          => 'required|in:BUY,SELL',
            'quantity'      => 'required|integer|min:1',
            'lot_type'      => 'required|in:micro,mini,standard,large,mega',
            'type'          => 'required|in:MARKET,LIMIT,SL-LIMIT,SL-MARKET',
            'price'         => 'nullable|numeric',
            'trigger_price' => 'nullable|numeric',
            'stop_loss'     => 'nullable|numeric',
            'target'        => 'nullable|numeric',
            'is_robo'       => 'boolean',
            'user_id'       => 'sometimes|integer',
            'challenge_id'  => 'nullable|integer',
        ]);

        // 2️⃣ Resolve user
        $user = Auth::user() ?? User::find(Session::get('LoggedIn')) ?? User::find($request->user_id ?? 0);
        if (!$user) {
            return response()->json(['message' => 'Unauthorized user.'], 401);
        }

        // 🔥 FIX: robust logic to find the Challenge ID
        $challengeId = $request->challenge_id; // Try getting from Frontend first

        if (!$challengeId) {
            // Fallback: Find the latest active challenge for this user in DB
            $challenge = Challenge::where('user_id', $user->id)
                ->where('status', 'active')
                ->orderBy('created_at', 'desc')
                ->first();

            $challengeId = $challenge ? $challenge->id : null;
        }

        // ⚠️ Final Safety Net: If your DB *requires* an ID and user has no challenge,
        // you must decide whether to block the trade or use a dummy ID.
        // Uncomment the line below to BLOCK trades without a challenge:
        // if (!$challengeId) return response()->json(['message' => 'No active challenge found.'], 422);

        // 3️⃣ Mega lot permission
        if ($request->lot_type === 'mega' && !$user->can_trade_mega) {
            return response()->json(['message' => 'Mega lot is locked.'], 403);
        }

        // 4️⃣ Map constants
        $sideMap = ['BUY' => Order::SIDE_BUY, 'SELL' => Order::SIDE_SELL];
        $typeMap = [
            'LIMIT'      => Order::TYPE_LIMIT,
            'MARKET'     => Order::TYPE_MARKET,
            'SL-LIMIT'   => Order::TYPE_SL,
            'SL-MARKET'  => Order::TYPE_SL_M
        ];

        // 5️⃣ Fetch instrument
        $instrument = Instrument::where('symbol', $request->symbol)->first();
        if (!$instrument) {
            return response()->json(['message' => 'Invalid symbol'], 404);
        }
        $tickSize = $instrument->tick_size;

        // 6️⃣ Determine execution price
        $executionPrice = $request->price ?? 0;
        if ($request->type === 'MARKET' || $executionPrice <= 0) {
            $executionPrice = $instrument->underlyingState?->last_price ?? $instrument->base_price;
        }
        $executionPrice = round($executionPrice / $tickSize) * $tickSize;

        // 7️⃣ Prepare Stop Loss & Target
        $stopLoss = $request->stop_loss !== null ? round($request->stop_loss / $tickSize) * $tickSize : null;
        $target   = $request->target !== null ? round($request->target / $tickSize) * $tickSize : null;

        // 8️⃣ Validate SL/Target
        if ($stopLoss !== null || $target !== null) {
            if ($request->side === 'BUY') {
                if ($stopLoss !== null && $stopLoss >= $executionPrice) {
                    return response()->json(['message' => 'Stop Loss for BUY must be BELOW entry price'], 422);
                }
                if ($target !== null && $target <= $executionPrice) {
                    return response()->json(['message' => 'Target for BUY must be ABOVE entry price'], 422);
                }
            } elseif ($request->side === 'SELL') {
                if ($stopLoss !== null && $stopLoss <= $executionPrice) {
                    return response()->json(['message' => 'Stop Loss for SELL must be ABOVE entry price'], 422);
                }
                if ($target !== null && $target >= $executionPrice) {
                    return response()->json(['message' => 'Target for SELL must be BELOW entry price'], 422);
                }
            }
        }

        // 9️⃣ Create Order
        $order = Order::create([
            'user_id'        => $user->id,
            'challenge_id'   => $challengeId, // ✅ Pass ID
            'lot_type'       => $request->lot_type,
            'stock_symbol'   => $request->symbol,
            'security_id'    => '0000',
            'order_side'     => $sideMap[$request->side],
            'order_type'     => $typeMap[$request->type],
            'quantity'       => $request->quantity,
            'filled_quantity'=> ($request->type === 'MARKET') ? $request->quantity : 0,
            'price'          => $executionPrice,
            'trigger_price'  => $request->trigger_price,
            'product_type'   => $request->product ?? 'MIS',
            'status'         => Order::STATUS_OPEN,
            'stop_loss'      => $stopLoss,
            'target'         => $target,
        ]);

        // 1️⃣0️⃣ Immediate execution for MARKET orders (non-robo)
        if ($request->type === 'MARKET' && !$request->is_robo) {
            $trade = Trade::create([
                'user_id'      => $user->id,
                'challenge_id' => $challengeId, // ✅ Pass ID
                'order_id'     => $order->id,   // ✅ Ensure this column exists in Trades table
                'symbol'       => $request->symbol,
                'side'         => $request->side,
                'lot_type'     => $request->lot_type,
                'qty'          => $request->quantity,
                'entry_price'  => $executionPrice,
                'status'       => 'OPEN',
                'entry_time'   => now(),
            ]);

            $order->update([
                'status'        => Order::STATUS_COMPLETED,
                'average_price' => $executionPrice
            ]);

            return response()->json([
                'message'  => 'Market order executed',
                'trade_id' => $trade->id
            ]);
        }

        // 1️⃣1️⃣ Response
        if ($request->is_robo || ($stopLoss !== null || $target !== null)) {
             $diagramDescription = $request->side === 'BUY'
                ? ''
                : '';

             return response()->json([
                'message'         => 'Smart order placed & monitoring SL/Target',
                'order_id'        => $order->id,
                'diagram_trigger' => $diagramDescription
            ]);
        }

        return response()->json([
            'message'  => 'Order placed successfully',
            'order_id' => $order->id
        ]);
    }
}
