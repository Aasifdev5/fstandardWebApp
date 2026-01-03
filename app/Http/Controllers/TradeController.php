<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Services\TradePricingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TradeController extends Controller
{
    protected $pricingService;

    // Fallback constants if plan data is missing
    const DEFAULT_STARTING_BALANCE = 1000000;
    const DEFAULT_TARGET_PERCENT = 0.10;
    const DEFAULT_MAX_DRAWDOWN = 0.10;

    public function __construct(TradePricingService $pricingService)
    {
        $this->pricingService = $pricingService;
    }

    /**
     * Close an active trade and calculate P/L according to F-Standard rules.
     */
    public function close(Request $request, $tradeId)
    {
        $request->validate([
            'exit_price' => 'required|numeric',
        ]);

        // Resolve User
        $user = Auth::user();
        if (!$user && Session::has('LoggedIn')) {
            $user = User::find(Session::get('LoggedIn'));
        }

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $trade = Trade::where('user_id', $user->id)->findOrFail($tradeId);

        if ($trade->status === 'CLOSED') {
            return response()->json(['message' => 'Trade already closed'], 400);
        }

        // 1. Get Exit Details
        $exitPrice = $request->input('exit_price');

        // 2. Calculate Raw Points
        $points = ($trade->side === 'BUY') // Assuming 'side' stores BUY/SELL
            ? $exitPrice - $trade->entry_price
            : $trade->entry_price - $exitPrice;

        // 3. Calculate ₹ Per Point using the Service
        // F-Standard Rule: Use ENTRY PRICE for the calculation anchor
        $rupeesPerPoint = $this->pricingService->rupeesPerPoint(
            $user->account_balance,    // Account Size
            $trade->lot_type,          // Lot Type
            $trade->symbol,            // Instrument Symbol
            $trade->entry_price        // Price level at entry
        );

        // 4. Calculate Final P/L
        $pnl = (float) ($points * $rupeesPerPoint);

        // 5. Save & Update User Balance
        $trade->update([
            'exit_price' => $exitPrice,
            'pnl'        => $pnl,
            'status'     => 'CLOSED',
            'exit_time'  => now(),
        ]);

        // Update Balance
        $user->account_balance += $pnl;
        $user->save();

        // 6. Check for Mega Lot Unlock (Step D)
        if ($pnl > 0) {
            $this->checkMegaLotUnlock($user);
        }

        // 7. Check Target & Drawdown Compliance (Step E)
        $accountStatus = $this->evaluateAccountStatus($user);

        return response()->json([
            'message' => 'Trade closed successfully',
            'pnl' => $pnl,
            'rupees_per_point' => $rupeesPerPoint,
            'account_status' => $accountStatus,
            'new_balance' => $user->account_balance
        ]);
    }

    /**
     * Logic to unlock "Mega" lot after conditions.
     */
    private function checkMegaLotUnlock($user)
    {
        // Rule: Unlock if 3 profitable trades exist
        $wins = Trade::where('user_id', $user->id)->where('pnl', '>', 0)->count();

        // Ensure we only update if currently locked
        if ($wins >= 3 && !$user->can_trade_mega) {
            $user->can_trade_mega = true;
            $user->save();
        }
    }

    /**
     * [Step E] Evaluate Targets & Drawdowns based on Equity.
     */
    private function evaluateAccountStatus($user)
    {
        // Fetch Active Plan to get specific targets
        $plan = DB::table('plan_purchases')
            ->join('funding_plans', 'plan_purchases.funding_plan_id', '=', 'funding_plans.id')
            ->where('plan_purchases.user_id', $user->id)
            ->where('plan_purchases.status', 'approved')
            ->orderBy('plan_purchases.created_at', 'desc')
            ->select('funding_plans.capital', 'funding_plans.profit_target', 'funding_plans.max_loss')
            ->first();

        $startingBalance = $plan ? $plan->capital : self::DEFAULT_STARTING_BALANCE;

        // Parse percentages (e.g., "8%" -> 0.08) or use defaults
        $targetPercent = $plan ? (floatval($plan->profit_target) / 100) : self::DEFAULT_TARGET_PERCENT;
        $maxLossPercent = $plan ? (floatval($plan->max_loss) / 100) : self::DEFAULT_MAX_DRAWDOWN;

        // Calculate Net P/L
        $currentEquity = $user->account_balance;
        $netPnl = $currentEquity - $startingBalance;

        // 1. Check Drawdown (Failure)
        if ($netPnl <= -($startingBalance * $maxLossPercent)) {
            if ($user->status !== 'FAILED') {
                $user->status = 'FAILED';
                $user->save();
            }
            return 'failed';
        }

        // 2. Check Target (Pass)
        if ($netPnl >= ($startingBalance * $targetPercent)) {
            if ($user->status !== 'PASSED') {
                $user->status = 'PASSED';
                $user->save();
            }
            return 'passed';
        }

        return 'active';
    }
}
