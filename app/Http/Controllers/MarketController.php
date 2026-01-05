<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Instrument;
use App\Models\User;
use App\Models\Order;
use App\Models\Challenge;
use App\Models\MarketSetting;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MarketController extends Controller
{
    private function getActiveChallenge($userId)
    {
        return Challenge::where('user_id', $userId)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->first();
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
        // 1. ORDERS TAB
        $rawOrders = Order::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(50)
            ->get();

        $orders = $rawOrders->map(function ($order) {
            return [
                'id'         => $order->id,
                'time'       => $order->created_at->format('H:i:s'),
                'side'       => $order->order_side === Order::SIDE_BUY ? 'BUY' : 'SELL',
                'type'       => $this->mapOrderType($order->order_type),
                'symbol'     => $order->stock_symbol,
                'product'    => $order->product_type,
                'qty'        => (float) $order->quantity,
                'price'      => (float) $order->price,
                'status'     => $this->mapOrderStatus($order->status),
            ];
        });

        // 2. POSITIONS TAB
        $rawPositions = Order::where('user_id', $userId)
            ->whereIn('product_type', ['MIS', 'INTRADAY', 'CO', 'BO'])
            // Fix: Include if status is Completed OR if filled_quantity > 0 (partial/error case)
            ->where(function($q) {
                $q->where('status', Order::STATUS_COMPLETED)
                  ->orWhere('filled_quantity', '>', 0);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $positions = $rawPositions->map(function ($pos) {
            $isOpen = is_null($pos->exit_price);
            return [
                'id'            => $pos->id,
                'symbol'        => $pos->stock_symbol,
                'product'       => $pos->product_type,
                'quantity'      => (float) $pos->quantity,
                'average_price' => (float) $pos->price,
                'ltp'           => (float) ($pos->exit_price ?? $pos->price),
                'pnl'           => (float) $pos->pnl,
                'close_reason'  => $pos->close_reason,
                'is_open'       => $isOpen,
            ];
        });

        // 3. HOLDINGS TAB
        $rawHoldings = Order::where('user_id', $userId)
            ->where('product_type', 'CNC')
            // 🔥 FIX: Check filled_quantity > 0 instead of strict status check
            // This catches orders that crashed mid-execution but were filled
            ->where('filled_quantity', '>', 0)
            ->whereNull('exit_price')
            ->get();

        $holdings = $rawHoldings->map(function ($hold) {
            return [
                'id'            => $hold->id,
                'symbol'        => $hold->stock_symbol,
                'quantity'      => (float) $hold->quantity,
                'average_price' => (float) $hold->price,
                'ltp'           => (float) $hold->price,
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

    public function index()
    {
        if (!Session::has('LoggedIn')) return redirect()->route('login');

        $userId       = Session::get('LoggedIn');
        $user_session = User::find($userId);
        $activeChallenge = $this->getActiveChallenge($userId);
        $lotConfig    = $this->getLiveLotConfig();
        $tradingData  = $this->getUserTradingData($userId);

        $instruments = Instrument::where('is_active', 1)->orderBy('symbol')->get();
        $first       = $instruments->first();

        return Inertia::render('Market/Market', [
            'instruments' => $instruments,
            'instrument'  => $first,
            'symbol'      => $first?->symbol,
            'expiry'      => null,
            'userState'   => [
                'id'              => $user_session->id,
                'name'            => $user_session->name,
                'can_trade_mega'  => $user_session->can_trade_mega ?? false,
                'account_balance' => $activeChallenge ? $activeChallenge->current_balance : $user_session->account_balance,
                'plan_title'      => $activeChallenge ? 'Active Challenge #' . $activeChallenge->id : 'No Active Plan',
                'capital'         => $activeChallenge ? $activeChallenge->start_balance : 0,
                'challenge_id'    => $activeChallenge ? $activeChallenge->id : null,
            ],
            'lotConfig'   => $lotConfig,
            'orders'      => $tradingData['orders'],
            'positions'   => $tradingData['positions'],
            'holdings'    => $tradingData['holdings'],
        ]);
    }

    public function show(Request $request, $symbol)
    {
        if (!Session::has('LoggedIn')) return redirect()->route('login');

        $userId       = Session::get('LoggedIn');
        $user_session = User::find($userId);
        $activeChallenge = $this->getActiveChallenge($userId);
        $lotConfig    = $this->getLiveLotConfig();
        $tradingData  = $this->getUserTradingData($userId);

        $instrument = Instrument::with(['underlyingState', 'contracts' => function($q) {
            $q->active()->with(['futuresState', 'optionsState']);
        }])->where('symbol', $symbol)->firstOrFail();

        return Inertia::render('Market/Chart', [
            'instrument' => $instrument,
            'symbol'     => $symbol,
            'expiry'     => $request->query('expiry'),
            'userState'  => [
                'id'              => $user_session->id,
                'name'            => $user_session->name,
                'can_trade_mega'  => $user_session->can_trade_mega ?? false,
                'account_balance' => $activeChallenge ? $activeChallenge->current_balance : $user_session->account_balance,
                'plan_title'      => $activeChallenge ? 'Active Challenge #' . $activeChallenge->id : 'No Active Plan',
                'capital'         => $activeChallenge ? $activeChallenge->start_balance : 0,
                'challenge_id'    => $activeChallenge ? $activeChallenge->id : null,
            ],
            'lotConfig'   => $lotConfig,
            'orders'      => $tradingData['orders'],
            'positions'   => $tradingData['positions'],
            'holdings'    => $tradingData['holdings'],
        ]);
    }
}
