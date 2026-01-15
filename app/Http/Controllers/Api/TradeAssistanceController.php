<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trade;

class TradeAssistanceController extends Controller
{
    /**
     * Get latest assistance suggestion for a trade
     */
    public function show(Request $request, Trade $trade)
    {
        // 🔐 Ownership check
        abort_if($trade->user_id !== $request->user()->id, 403);

        $log = $trade->assistanceLogs()->latest()->first();

        if (!$log) {
            return response()->json([
                'message' => 'No assistance suggestion yet'
            ], 404);
        }

        return response()->json([
            'suggested_hedge_type' => $log->suggested_hedge_type,
            'explanation'          => $log->explanation,
            'user_action'          => $log->user_action,
            'exposure_profile'     => $log->exposure_profile,
        ]);
    }

    /**
     * Update user action on assistance suggestion
     */
    public function updateAction(Request $request, Trade $trade)
    {
        // 🔐 Ownership check
        abort_if($trade->user_id !== $request->user()->id, 403);

        $request->validate([
            'action' => 'required|in:VIEWED,EXECUTED,IGNORED',
        ]);

        $log = $trade->assistanceLogs()->latest()->first();

        abort_if(!$log, 404);

        $log->update([
            'user_action' => $request->action,
        ]);

        return response()->json([
            'success' => true,
            'action'  => $request->action,
        ]);
    }
}
