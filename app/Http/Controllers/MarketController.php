<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Instrument;
use App\Models\User;
use App\Models\Order;
use App\Models\Trade;     // Active Positions table
use App\Models\TradeLog;  // Closed/History table
use App\Models\Challenge;
use App\Models\MarketSetting;
use Illuminate\Support\Facades\Session;

class MarketController extends Controller
{
    private function getSimulationState()
    {
        $setting = MarketSetting::first();
        return [
            'is_active'    => $setting->is_simulation_active ?? false,
            'current_date' => $setting->current_simulated_date ?? now()->format('Y-m-d H:i:s'),
            'status'       => ($setting->is_market_open ?? false) ? 'OPEN' : 'CLOSED',
        ];
    }

    private function getActiveChallenge($userId)
    {
        $challenge = Challenge::where('user_id', $userId)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->first();

        // 🔥 CRITICAL FIX: Force update stats from TradeLogs before returning
        if ($challenge) {
            $challenge->refreshStats();
        }

        return $challenge;
    }

    private function getLiveLotConfig()
    {
        $config = MarketSetting::getSimulationConfig();
        return $config['lot_multipliers'] ?? [
            'micro' => 0.25, 'mini' => 0.50, 'standard' => 1.00, 'large' => 2.00, 'mega' => 5.00,
        ];
    }

    private function getUserTradingData($userId)
    {
        // ---------------------------------------------------------
        // 1. ORDERS TAB (History from Orders Table)
        // ---------------------------------------------------------
        $rawOrders = Order::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(50)
            ->get();

        $orders = $rawOrders->map(function ($order) {
            return [
                'id'         => $order->id,
                'time'       => $order->created_at->format('H:i:s'),
                'date'       => $order->created_at->format('Y-m-d'),
                'side'       => $order->order_side === Order::SIDE_BUY ? 'BUY' : 'SELL',
                'type'       => $this->mapOrderType($order->order_type),
                'symbol'     => $order->stock_symbol,
                'product'    => $order->product_type,
                'qty'        => (float) $order->quantity,
                'price'      => (float) $order->price,
                'status'     => $this->mapOrderStatus($order->status),
            ];
        });

        // ---------------------------------------------------------
        // 2. POSITIONS TAB (ONLY Active Trades from 'trades' table)
        // ---------------------------------------------------------
        $rawPositions = Trade::where('user_id', $userId)
            ->where('status', 'OPEN') // 🔥 Ensures CLOSED trades never appear here
            ->orderBy('created_at', 'desc')
            ->get();

        $positions = $rawPositions->map(function ($trade) {
            return [
                'id'            => $trade->id,
                'symbol'        => $trade->symbol,
                'product'       => 'MIS',
                'quantity'      => (float) $trade->qty,
                'average_price' => (float) $trade->entry_price,
                'ltp'           => (float) ($trade->ltp ?? $trade->entry_price),
                'pnl'           => (float) $trade->pnl,
                'side'          => $trade->side,
                'is_open'       => true,
            ];
        });

        // ---------------------------------------------------------
        // 3. HOLDINGS TAB (CNC Only + Logic to exclude Closed)
        // ---------------------------------------------------------
        $rawHoldings = Order::where('user_id', $userId)
            ->where('product_type', 'CNC') // STRICTLY CNC
            ->where('filled_quantity', '>', 0)
            ->whereNull('exit_price') // Not sold in Orders table logic
            ->get();

        // 🔥 CRITICAL FIX: Filter out "Ghost Holdings"
        // If a trade exists in 'trades' table with status 'CLOSED' for this order,
        // it means the holding is gone, even if 'orders' table wasn't updated.
        $validHoldings = $rawHoldings->filter(function($order) {
            $isClosedInTrades = Trade::where('order_id', $order->id)
                                     ->where('status', 'CLOSED')
                                     ->exists();

            // Also check TradeLogs (History) just in case it was moved there
            $isClosedInLogs = TradeLog::whereJsonContains('order_ids', (string)$order->id)->exists();

            return !($isClosedInTrades || $isClosedInLogs);
        });

        $holdings = $validHoldings->values()->map(function ($hold) {
            return [
                'id'            => $hold->id,
                'symbol'        => $hold->stock_symbol,
                'quantity'      => (float) $hold->quantity,
                'average_price' => (float) $hold->price,
                'ltp'           => (float) $hold->price, // Placeholder for live price
                'pnl'           => 0,
            ];
        });

        return compact('orders', 'positions', 'holdings');
    }

    private function mapOrderStatus($status)
    {
        return match ($status) {
            Order::STATUS_OPEN      => 'OPEN',
            Order::STATUS_COMPLETED => 'EXECUTED',
            Order::STATUS_PARTIAL   => 'PARTIAL',
            Order::STATUS_CANCELLED => 'CANCELLED',
            default                 => 'UNKNOWN',
        };
    }

    private function mapOrderType($type)
    {
        return match ($type) {
            Order::TYPE_LIMIT  => 'LIMIT',
            Order::TYPE_MARKET => 'MARKET',
            Order::TYPE_SL     => 'SL',
            Order::TYPE_SL_M   => 'SL-M',
            default            => 'LIMIT',
        };
    }

    private function buildMarketResponse($user_session, $activeChallenge, $instruments, $selectedInstrument, $expiry = null)
    {
        $userId = $user_session->id;
        $lotConfig   = $this->getLiveLotConfig();
        $tradingData = $this->getUserTradingData($userId); // Fetches clean data
        $simState    = $this->getSimulationState();

        return [
            'instruments' => $instruments,
            'instrument'  => $selectedInstrument,
            'symbol'      => $selectedInstrument?->symbol,
            'expiry'      => $expiry,
            'simulation'  => $simState,
            'userState'   => [
                'id'               => $user_session->id,
                'name'             => $user_session->name,
                'email'            => $user_session->email,
                'can_trade_mega'   => $user_session->can_trade_mega ?? false,
                // 🔥 Updated Balance from Challenge
                'account_balance'  => $activeChallenge ? $activeChallenge->current_balance : $user_session->account_balance,
                'plan_title'       => $activeChallenge ? 'Active Challenge #' . $activeChallenge->id : 'No Active Plan',
                'capital'          => $activeChallenge ? $activeChallenge->start_balance : 0,
                'challenge_id'     => $activeChallenge ? $activeChallenge->id : null,
                'websocket_channel'=> 'user.' . $user_session->id,
            ],
            'lotConfig' => $lotConfig,
            'orders'    => $tradingData['orders'],
            'positions' => $tradingData['positions'],
            'holdings'  => $tradingData['holdings'],
        ];
    }

    public function index()
    {
        if (!Session::has('LoggedIn')) return redirect()->route('login');
        $userId = Session::get('LoggedIn');
        $user_session = User::find($userId);
        if (!$user_session) {
            Session::forget('LoggedIn');
            return redirect()->route('login');
        }

        $activeChallenge = $this->getActiveChallenge($userId);
        $instruments = Instrument::where('is_active', 1)->orderBy('symbol')->get();
        $firstInstrument = $instruments->first();

        return Inertia::render('Market/Market',
            $this->buildMarketResponse($user_session, $activeChallenge, $instruments, $firstInstrument)
        );
    }

    public function show(Request $request, $symbol)
    {
        if (!Session::has('LoggedIn')) return redirect()->route('login');
        $userId = Session::get('LoggedIn');
        $user_session = User::find($userId);
        if (!$user_session) {
            Session::forget('LoggedIn');
            return redirect()->route('login');
        }

        $activeChallenge = $this->getActiveChallenge($userId);

        $instrument = Instrument::with(['underlyingState', 'contracts' => function($q) {
            $q->active()->with(['futuresState', 'optionsState']);
        }])->where('symbol', $symbol)->firstOrFail();

        // Optimized instrument list for sidebar
        $instruments = Instrument::select('id', 'symbol', 'name', 'type')
            ->where('is_active', 1)
            ->orderBy('symbol')
            ->get();

        return Inertia::render('Market/Chart',
            $this->buildMarketResponse(
                $user_session,
                $activeChallenge,
                $instruments,
                $instrument,
                $request->query('expiry')
            )
        );
    }
}
