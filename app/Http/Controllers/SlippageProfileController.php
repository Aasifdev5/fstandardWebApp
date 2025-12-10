<?php

namespace App\Http\Controllers;

use App\Models\SlippageProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SlippageProfileController extends Controller
{
    public function index()
    {
        if (!Session::has('LoggedIn')) return redirect()->route('login');
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $profiles = SlippageProfile::with('user')->paginate(50);
        return view('admin.slippage-profiles.index', compact('profiles','user_session'));
    }

    public function show($id)
    {
        if (!Session::has('LoggedIn')) return redirect()->route('login');
        $profile = SlippageProfile::with('user')->findOrFail($id);
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        return view('admin.slippage-profiles.show', compact('profile','user_session'));
    }

    public function destroy($id)
    {
        if (!Session::has('LoggedIn')) return response()->json(['success' => false], 401);
        SlippageProfile::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function bulkDelete(Request $request)
    {
        if (!Session::has('LoggedIn')) return response()->json(['success' => false], 401);
        $ids = $request->input('ids', []);
        SlippageProfile::whereIn('id', $ids)->delete();
        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'min_slippage' => 'numeric',
            'max_slippage' => 'numeric',
            'symbol_overrides' => 'nullable|array',
            'time_overrides' => 'nullable|array',
            'active' => 'boolean'
        ]);

        $profile = SlippageProfile::create($data);

        return response()->json([
            'status' => 'ok',
            'profile' => $profile
        ]);
    }

    public function update(Request $request, $id)
    {
        $profile = SlippageProfile::findOrFail($id);

        $data = $request->validate([
            'min_slippage' => 'numeric',
            'max_slippage' => 'numeric',
            'symbol_overrides' => 'nullable|array',
            'time_overrides' => 'nullable|array',
            'active' => 'boolean'
        ]);

        $profile->update($data);

        return response()->json(['status' => 'updated', 'profile' => $profile]);
    }
}
