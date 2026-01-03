<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Instrument;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MarketController extends Controller
{
    private function getActivePlan($userId)
    {
        return DB::table('plan_purchases')
            ->join('funding_plans', 'plan_purchases.funding_plan_id', '=', 'funding_plans.id')
            ->where('plan_purchases.user_id', $userId)
            ->where('plan_purchases.status', 'approved')
            ->orderBy('plan_purchases.created_at', 'desc')
            ->select(
                'funding_plans.title as plan_title',
                'funding_plans.capital'
            )
            ->first();
    }

    public function index()
    {
        if (!Session::has('LoggedIn')) return redirect()->route('login');

        $userId = Session::get('LoggedIn');
        $user_session = User::find($userId);
        $activePlan = $this->getActivePlan($userId);

        $instruments = Instrument::where('is_active', 1)->orderBy('symbol')->get();
        $first = $instruments->first();

        return Inertia::render('Market/Market', [
            'instruments' => $instruments,
            'instrument'  => $first,
            'symbol'      => $first?->symbol,
            'expiry'      => null,
            'userState'   => [
                'id'              => $user_session->id,
                'name'            => $user_session->name,
                'can_trade_mega'  => $user_session->can_trade_mega ?? false,
                'account_balance' => $user_session->account_balance,
                'plan_title'      => $activePlan ? $activePlan->plan_title : 'No Active Plan',
                'capital'         => $activePlan ? $activePlan->capital : 0,
            ],
            'lotConfig'   => config('market_pricing.lot_multipliers'),
        ]);
    }

    public function show(Request $request, $symbol)
    {
        if (!Session::has('LoggedIn')) return redirect()->route('login');

        $userId = Session::get('LoggedIn');
        $user_session = User::find($userId);
        $activePlan = $this->getActivePlan($userId);

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
                'account_balance' => $user_session->account_balance,
                'plan_title'      => $activePlan ? $activePlan->plan_title : 'No Active Plan',
                'capital'         => $activePlan ? $activePlan->capital : 0,
            ],
            'lotConfig' => config('market_pricing.lot_multipliers'),
        ]);
    }
}
