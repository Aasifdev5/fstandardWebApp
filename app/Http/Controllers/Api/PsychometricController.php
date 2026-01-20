<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PsychometricState;
use App\Models\PsychometricSnapshot;

class PsychometricController extends Controller
{
    /**
     * Get latest psychometric snapshot, state and explanation
     */
    public function overview(Request $request)
    {
        $user = $request->user();

        // 1. Get the current rolling state (for the Radar Chart)
        $currentState = PsychometricState::where('user_id', $user->id)->first();

        // Fallback for new users
        if (!$currentState) {
            $currentState = (object) [
                'confidence' => 0.5,
                'fear' => 0.5,
                'discipline' => 0.5,
                'aggression' => 0.5
            ];
        }

        // 2. Get the most recent immutable snapshot
        $latestSnapshot = PsychometricSnapshot::where('user_id', $user->id)
            ->latest()
            ->first();

        // 3. Generate the behavioral insight
        $explanation = $this->generateExplanation($currentState);

        return response()->json([
            'latest_snapshot' => $latestSnapshot,
            'current_state'   => $currentState,
            'explanation'     => $explanation,
        ]);
    }

    /**
     * Internal logic to generate behavioral insights
     * Changed to PUBLIC so the Console Command can access it
     */
    public function generateExplanation($state): string
    {
        if (!$state) return "Keep trading to allow the engine to analyze your discipline.";

        // Ensure we are working with an object even if an array is passed
        $data = is_array($state) ? (object) $state : $state;

        if (isset($data->discipline) && $data->discipline < 0.4) {
            return "Your discipline score is low. You are likely 'revenge trading' after losses. Close the terminal and reset.";
        }

        if (isset($data->aggression) && $data->aggression > 0.8) {
            return "High aggression detected. You are over-leveraged. A small market move against you could hit your Stop Loss early.";
        }

        if (isset($data->confidence) && $data->confidence > 0.8) {
            return "Excellent consistency! Your confidence is backed by solid results. Maintain your current risk parameters.";
        }

        return "Your trading behavior is stable. Discipline is within healthy parameters.";
    }

    /**
     * Helper for quick AI updates
     */
    public function latestExplanation(Request $request)
    {
        $user = $request->user();
        $state = PsychometricState::where('user_id', $user->id)->first();

        return response()->json([
            'explanation' => $this->generateExplanation($state),
        ]);
    }
}
