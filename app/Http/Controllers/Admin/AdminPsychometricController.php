<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminPsychometricController extends Controller
{
    public function index()
    {
        if (!Session::has('LoggedIn')) {
            return redirect('Userlogin')->with('fail', 'Please login first.');
        }

        $user_session = User::findOrFail(Session::get('LoggedIn'));

        $traders = User::where('account_type', 'user')
            ->with(['psychometricState', 'latestExplanation', 'latestSnapshot'])
            ->get()
            ->map(function ($user) {
                $user->risk_status = $this->calculateRiskStatus($user->psychometricState);
                return $user;
            });

        $stats = [
            'total' => $traders->count(),
            'high_risk' => $traders->where('risk_status', 'High Risk')->count(),
            'stable' => $traders->where('risk_status', 'Stable')->count(),
        ];

        return view('admin.psychometrics.index', compact('traders', 'stats', 'user_session'));
    }

    private function calculateRiskStatus($state)
    {
        if (!$state) return 'No Data';

        if ($state->discipline < 0.3 || $state->aggression > 0.8) return 'High Risk';
        if ($state->discipline < 0.5) return 'Medium Risk';

        return 'Stable';
    }
}
