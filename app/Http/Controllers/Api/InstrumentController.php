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
    // List all active instruments
    public function index()
    {
        return Instrument::with('underlyingState')
            ->active()
            ->get();
    }

    // Show details for a specific instrument
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

    // Get Option Chain
    public function optionChain(Request $request, string $symbol)
    {
        $instrument = Instrument::where('symbol', $symbol)->firstOrFail();

        // Default expiry to next month's last Thursday if not provided
        $expiry = $request->query(
            'expiry_date',
            Carbon::now()
                ->addMonth()
                ->lastOfMonth()
                ->previous(Carbon::THURSDAY)
                ->format('Y-m-d')
        );

        $contracts = Contract::where('instrument_id', $instrument->id)
            ->whereDate('expiry_date', $expiry)
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
            ->values(); // Reset keys to array

        return response()->json($contracts);
    }

    // Get Candles (Historical Data)
    public function candles(Request $request, string $symbol)
    {
        // Default to 1m, but accept 3m, 5m, 15m, etc. from frontend
        $timeframe = $request->query('timeframe', '1m');
        $limit = (int) $request->query('limit', 200);

        return Candle::where('symbol', $symbol)
            ->where('timeframe', $timeframe)
            ->orderBy('timestamp', 'desc') // Get latest first
            ->limit($limit)
            ->get()
            ->reverse() // Reverse to chronological order for the chart (Oldest -> Newest)
            ->values();
    }
}
