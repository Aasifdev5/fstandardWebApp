<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MarketSimulationController extends Controller
{
    /**
     * GET: Show the settings form
     */
    public function index()
    {
        // Fetch existing settings or return empty array if first run
        $settings = MarketSetting::where('key', 'simulation_config')->first();
        $config = $settings ? $settings->value : [];

        // Fetch user session (preserving your existing logic)
        $user_session = session('LoggedIn')
            ? \App\Models\User::find(session('LoggedIn'))
            : null;

        // Define the known instruments list so the view can generate the table rows
        // even if the database config is currently empty.
        $knownInstruments = [
            'FSI-NF50-F', 'FSI-BN-F', 'FSI-SENSEX-F', 'FSI-FN-F', 'FSI-MIDCP-F',
            'FSI-RIL-F', 'FSI-HDFB-F', 'FSI-ICBK-F', 'FSI-INFY-F', 'FSI-TCS-F',
            'FSI-SBIN-F', 'FSI-ADAN-F', 'FSI-TATA-MTR-F', 'FSI-JSW-F', 'FSI-LT-F',
        ];

        // Return the Blade view with all necessary data
        return view('admin.simulation-settings', compact('config', 'user_session', 'knownInstruments'));
    }

    /**
     * POST: Update settings
     */
    public function update(Request $request)
    {
        // 1. Validate the structure matches your Blade form arrays
        $validated = $request->validate([
            // --- Simulation Engine Settings ---
            'volatility_by_class' => 'required|array',
            'time_of_day_multipliers' => 'required|array',
            'regimes' => 'required|array',
            'news' => 'nullable|array',

            // --- Pricing & Constants Settings ---
            'base_rupee_per_point' => 'required|numeric|min:0',
            'reference_price'      => 'required|numeric|min:0',
            'reference_account'    => 'required|numeric|min:0',

            // --- Multipliers ---
            'lot_multipliers'      => 'required|array',
            'lot_multipliers.*'    => 'required|numeric|min:0', // Validate values inside array

            'instrument_multipliers'   => 'required|array',
            'instrument_multipliers.*' => 'required|numeric|min:0', // Validate values inside array
        ]);

        // 2. Prepare Data: Exclude _token and _method so they don't get saved in the JSON
        $dataToSave = $request->except(['_token', '_method']);

        // 3. Save to Database
        MarketSetting::updateOrCreate(
            ['key' => 'simulation_config'],
            ['value' => $dataToSave] // The 'casts' => 'array' in your model handles JSON encoding
        );

        // 4. CRITICAL: Clear the cache so the running loop picks up changes immediately
        Cache::forget('market_simulation_config');

        return back()->with('success', 'Market parameters and pricing updated. The engine will pick up changes in < 1 second.');
    }
}
