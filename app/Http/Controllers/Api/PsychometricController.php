<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PsychometricController extends Controller
{
    /**
     * Get latest psychometric snapshot, state and explanation
     */
    public function overview(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'latest_snapshot' => $user->latest_psychometric_snapshot,
            'current_state'   => $user->psychometricState,
            'explanation'     => $user->latest_explanation,
        ]);
    }

    /**
     * Get only the latest AI explanation
     */
    public function latestExplanation(Request $request)
    {
        return response()->json([
            'explanation' => $request->user()->latest_explanation,
        ]);
    }
}
