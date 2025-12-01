<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemTradeConfig;
use Illuminate\Http\Request;

class SystemTradeConfigController extends Controller
{

    /**
     * Show the System Trade Config page
     */
    public function edit()
    {
        // Auto-create config with defaults if table is empty
        $config = SystemTradeConfig::firstOrCreate(
            ['id' => 1], // optional condition (only creates if not exists)
            [
                'max_buy_order'                            => 5,
                'min_decrease'                              => 1.00,
                'max_decrease'                              => 2.00,
                'buy_order_amount_range'                    => 10.00,
                'buy_order_matching_chance'                 => 0,
                'buy_order_matching_price_increase_up_to'   => 10.00,
                'max_sell_order'                            => 5,
                'min_increase'                              => 1.00,
                'max_increase'                              => 2.00,
                'sell_order_amount_range'                   => 10.00,
                'sell_order_matching_chance'                => 0,
                'sell_order_matching_price_decrease_up_to'  => 10.00,
                'buy_matching_with_system_trade'            => 'no',
                'sell_matching_with_system_trade'           => 'no',
                'buy_order_remains_minutes'                 => 5,
                'sell_order_remains_minutes'                => 5,
            ]
        );

        // Optional: Pass user session if your layout needs it
        $user_session = session('LoggedIn')
            ? \App\Models\User::find(session('LoggedIn'))
            : null;

        return view('admin.system-trade-config.edit', compact('config', 'user_session'));
    }

    /**
     * Update the configuration
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            // Buy Order Config
            'max_buy_order'                             => 'required|integer|min:1|max:100',
            'min_decrease'                               => 'required|numeric|min:0|max:100',
            'max_decrease'                               => 'required|numeric|min:0|max:100',
            'buy_order_amount_range'                     => 'required|numeric|min:0|max:100',
            'buy_order_matching_chance'                  => 'required|integer|min:0|max:100',
            'buy_order_matching_price_increase_up_to'    => 'required|numeric|min:0|max:100',
            'buy_matching_with_system_trade'             => 'required|in:yes,no',
            'buy_order_remains_minutes'                  => 'required|integer|min:1|max:1440',

            // Sell Order Config
            'max_sell_order'                             => 'required|integer|min:1|max:100',
            'min_increase'                               => 'required|numeric|min:0|max:100',
            'max_increase'                               => 'required|numeric|min:0|max:100',
            'sell_order_amount_range'                    => 'required|numeric|min:0|max:100',
            'sell_order_matching_chance'                 => 'required|integer|min:0|max:100',
            'sell_order_matching_price_decrease_up_to'   => 'required|numeric|min:0|max:100',
            'sell_matching_with_system_trade'            => 'required|in:yes,no',
            'sell_order_remains_minutes'                 => 'required|integer|min:1|max:1440',
        ]);

        // Get or create the config row
        $config = SystemTradeConfig::firstOrCreate(['id' => 1]);

        // Update with validated data
        $config->update($validated);

        return redirect()->back()->with('success', 'System Trade Configuration updated successfully!');
    }
}
