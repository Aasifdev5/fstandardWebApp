<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SimulationConfig;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SimulationConfigController extends Controller
{
    /**
     * Display the market simulation control dashboard.
     */
    public function index()
    {

        if (!Session::has('LoggedIn')) {
            return redirect()->back()->with('fail', 'You must log in first');
        }

        $user_session = User::find(Session::get('LoggedIn'));
        $global = SimulationConfig::whereNull('user_id')->first();

        $overrides = SimulationConfig::with('user')
            ->whereNotNull('user_id')
            ->latest()
            ->get();

        $users = User::where('account_type', '!=', 'admin')
            ->orderBy('name')
            ->get();

        return view('admin.simulation.index', compact('global', 'overrides', 'users','user_session'));
    }

    /**
     * Update global simulation setting (affects all users).
     */
    public function updateGlobal(Request $request)
    {


        $validated = $request->validate([
            'force_outcome' => 'required|in:NONE,TARGET_HIT,SL_HIT',
            'notes'         => 'nullable|string|max:500',
        ]);

        SimulationConfig::updateOrCreate(
            ['user_id' => null],
            [
                'force_outcome' => $validated['force_outcome'],
                'is_active'     => true,
                'notes'         => $validated['notes'] ?? null,
            ]
        );

        Cache::forget('simulation.global');

        return Redirect::route('profit-loss-control.index')
            ->with('success', 'Global profit/loss control updated successfully.');
    }

    /**
     * Store or update a user-specific override.
     */
    public function storeUserOverride(Request $request)
    {

        $validated = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'force_outcome' => 'required|in:NONE,TARGET_HIT,SL_HIT',
            'notes'         => 'nullable|string|max:500',
        ]);

        SimulationConfig::updateOrCreate(
            ['user_id' => $validated['user_id']],
            [
                'force_outcome' => $validated['force_outcome'],
                'is_active'     => true,
                'notes'         => $validated['notes'] ?? null,
            ]
        );

        Cache::forget("simulation.user.{$validated['user_id']}");

        return Redirect::route('profit-loss-control.index')
            ->with('success', 'User override saved successfully.');
    }

    /**
     * Remove a specific simulation override.
     */
    public function destroy($id)
    {


        $config = SimulationConfig::findOrFail($id);

        // Clear cache if it's a user-specific rule
        if ($config->user_id) {
            Cache::forget("simulation.user.{$config->user_id}");
        }

        $config->delete();

        return Redirect::route('profit-loss-control.index')
            ->with('success', 'Simulation override removed successfully.');
    }
}
