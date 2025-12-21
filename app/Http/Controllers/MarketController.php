<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Instrument;

class MarketController extends Controller
{
    // Show market page with all instruments
    public function index()
    {
        $instruments = Instrument::where('is_active', 1)
            ->orderBy('symbol')
            ->get();

        $firstInstrument = $instruments->first();

        return Inertia::render('Market/Market', [
            'instruments' => $instruments,
            'instrument' => $firstInstrument,
            'symbol' => $firstInstrument?->symbol,
            'expiry' => null,
        ]);
    }

    // Show single instrument page (optional)
    public function show(Request $request, $symbol)
    {
        $instrument = Instrument::with(['underlyingState', 'contracts' => function($q) {
            $q->active()->with(['futuresState', 'optionsState']);
        }])->where('symbol', $symbol)->firstOrFail();

        return Inertia::render('Market/Chart', [
            'instrument' => $instrument,
            'symbol' => $symbol,
            'expiry' => $request->query('expiry'),
        ]);
    }
}
