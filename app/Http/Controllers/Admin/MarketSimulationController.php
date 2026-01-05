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
        $settings = MarketSetting::where('key', 'simulation_config')->first();
        $config   = $settings ? $settings->value : [];

        $user_session = session('LoggedIn')
            ? \App\Models\User::find(session('LoggedIn'))
            : null;

        $knownInstruments = [
            'FSI-NF50-F', 'FSI-BN-F', 'FSI-SENSEX-F', 'FSI-FN-F', 'FSI-MIDCP-F',
            'FSI-RIL-F', 'FSI-HDFB-F', 'FSI-ICBK-F', 'FSI-INFY-F', 'FSI-TCS-F',
            'FSI-SBIN-F', 'FSI-ADAN-F', 'FSI-TATA-MTR-F', 'FSI-JSW-F', 'FSI-LT-F',
        ];

        return view(
            'admin.simulation-settings',
            compact('config', 'user_session', 'knownInstruments')
        );
    }

    /**
     * POST: Update settings
     */
    public function update(Request $request)
    {
        /**
         * 1️⃣ VALIDATION (Matches Blade exactly)
         */
        $validated = $request->validate([
            // Live engine controls
            'update_speed_ms'          => 'required|integer|min:50|max:5000',
            'global_stress_multiplier' => 'required|numeric|min:0.1|max:20',

            // Pricing constants
            'base_rupee_per_point'     => 'required|numeric|min:0',
            'reference_price'          => 'required|numeric|min:0',
            'reference_account'        => 'required|numeric|min:0',

            // Multipliers
            'lot_multipliers'          => 'required|array',
            'lot_multipliers.*'        => 'required|numeric|min:0',

            'instrument_multipliers'   => 'required|array',
            'instrument_multipliers.*' => 'required|numeric|min:0',

            // Engine simulation
            'volatility_by_class'      => 'required|array',
            'volatility_by_class.*'    => 'required|numeric|min:0',

            'time_of_day_multipliers'  => 'required|array',
            'time_of_day_multipliers.*'=> 'required|numeric|min:0',

            'regimes'                  => 'required|array',
            'regimes.*.drift'          => 'nullable|numeric',
            'regimes.*.volatility_multiplier' => 'nullable|numeric|min:0',

            'news'                     => 'nullable|array',
        ]);

        /**
         * 2️⃣ CLEAN PAYLOAD
         */
        $data = $request->except(['_token', '_method']);

        /**
         * 3️⃣ FORCE NUMERIC CASTING (CRITICAL)
         */
        $data['update_speed_ms']          = (int)   $data['update_speed_ms'];
        $data['global_stress_multiplier'] = (float) $data['global_stress_multiplier'];
        $data['base_rupee_per_point']     = (float) $data['base_rupee_per_point'];
        $data['reference_price']          = (float) $data['reference_price'];
        $data['reference_account']        = (float) $data['reference_account'];

        foreach ($data['lot_multipliers'] as $k => $v) {
            $data['lot_multipliers'][$k] = (float) $v;
        }

        foreach ($data['instrument_multipliers'] as $k => $v) {
            $data['instrument_multipliers'][$k] = (float) $v;
        }

        foreach ($data['volatility_by_class'] as $k => $v) {
            $data['volatility_by_class'][$k] = (float) $v;
        }

        foreach ($data['time_of_day_multipliers'] as $k => $v) {
            $data['time_of_day_multipliers'][$k] = (float) $v;
        }

        foreach ($data['regimes'] as $k => $regime) {
            $data['regimes'][$k]['drift'] =
                (float) ($regime['drift'] ?? 0);

            $data['regimes'][$k]['volatility_multiplier'] =
                (float) ($regime['volatility_multiplier'] ?? 1);
        }

        /**
         * 4️⃣ SAVE CONFIG
         */
        MarketSetting::updateOrCreate(
            ['key' => 'simulation_config'],
            ['value' => $data]
        );

        /**
         * 5️⃣ CLEAR CACHE (LIVE ENGINE PICKUP)
         */
        Cache::forget('market_simulation_config');

        return back()->with(
            'success',
            'Market simulation updated successfully. Live engine applied changes instantly.'
        );
    }
}
