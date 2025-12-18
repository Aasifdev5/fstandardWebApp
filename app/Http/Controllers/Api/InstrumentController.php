<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Instrument;
use App\Models\Contract;
use Carbon\Carbon;
use App\Models\Candle;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function index()
    {
        return Instrument::with('underlyingState')->active()->get();
    }

    public function show($symbol)
    {
        $instrument = Instrument::with(['underlyingState', 'contracts' => function ($q) {
            $q->with('futuresState', 'optionsState')->active();
        }])->where('symbol', $symbol)->firstOrFail();

        return $instrument;
    }

    public function optionChain(Request $request, $symbol)
    {
        $instrument = Instrument::where('symbol', $symbol)->firstOrFail();
        $expiry = $request->query('expiry', Carbon::now()->addMonth()->lastOfMonth()->previous(Carbon::THURSDAY)->format('Y-m-d'));

        $contracts = Contract::where('instrument_id', $instrument->id)
            ->where('expiry_date', $expiry)
            ->where('contract_type', 'OPTION')
            ->with('optionsState')
            ->get()
            ->groupBy('strike_price')
            ->map(function ($group, $strike) {
                $call = $group->where('option_type', 'CALL')->first();
                $put = $group->where('option_type', 'PUT')->first();
                return [
                    'strike' => $strike,
                    'call' => $call ? $call->load('optionsState') : null,
                    'put' => $put ? $put->load('optionsState') : null,
                ];
            });

        return response()->json($contracts);
    }

    public function candles(Request $request, $symbol)
    {
        $timeframe = $request->query('timeframe', '1m');
        $limit = $request->query('limit', 100);

        $candles = Candle::where('symbol', $symbol)
            ->where('timeframe', $timeframe)
            ->orderBy('timestamp', 'desc')
            ->limit($limit)
            ->get()
            ->reverse()
            ->values();

        return $candles;
    }
}
