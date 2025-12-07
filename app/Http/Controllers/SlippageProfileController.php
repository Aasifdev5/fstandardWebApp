<?php

namespace App\Http\Controllers;

use App\Models\SlippageProfile;
use Illuminate\Http\Request;

class SlippageProfileController extends Controller
{
    public function index()
    {
        return SlippageProfile::with('user')->paginate(20);
    }

    public function show($id)
    {
        return SlippageProfile::with('user')->findOrFail($id);
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
