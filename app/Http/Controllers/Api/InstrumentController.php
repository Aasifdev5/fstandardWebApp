<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Instrument;
use App\Models\Contract;
use App\Models\Candle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function index()
    {
        return Instrument::with('underlyingState')
            ->active()
            ->get();
    }

    public function show(string $symbol)
    {
        return Instrument::with(['underlyingState'])
            ->with(['contracts' => function ($query) {
                $query->active()
                      ->with(['futuresState', 'optionsState']);
            }])
            ->where('symbol', $symbol)
            ->firstOrFail();
    }

    public function optionChain(Request $request, string $symbol)
    {
        $instrument = Instrument::where('symbol', $symbol)->firstOrFail();

        // ⚠ Vue sends expiry_date, not expiry
        $expiry = $request->query(
            'expiry_date',
            Carbon::now()
                ->addMonth()
                ->lastOfMonth()
                ->previous(Carbon::THURSDAY)
                ->format('Y-m-d')
        );

        $contracts = Contract::where('instrument_id', $instrument->id)
            ->where('expiry_date', $expiry)
            ->where('contract_type', 'OPTION')
            ->with('optionsState')
            ->get()
            ->groupBy('strike_price')
            ->map(function ($group, $strike) {
                return [
                    'strike' => $strike,
                    'call' => $group->where('option_type', 'CALL')->first(),
                    'put'  => $group->where('option_type', 'PUT')->first(),
                ];
            })
            ->values();

        return response()->json($contracts);
    }

    public function candles(Request $request, string $symbol)
    {
        $timeframe = $request->query('timeframe', '1m');
        $limit = (int) $request->query('limit', 200);

        return Candle::where('symbol', $symbol)
            ->where('timeframe', $timeframe)
            ->orderBy('timestamp', 'desc')
            ->limit($limit)
            ->get()
            ->reverse()
            ->values();
    }
}
