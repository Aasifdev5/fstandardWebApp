<?php

namespace App\Http\Controllers;

use App\Models\DelayedFeedAssignment;
use Illuminate\Http\Request;

class DelayedFeedAssignmentController extends Controller
{
    public function index()
    {
        return DelayedFeedAssignment::with('user')
            ->orderBy('id', 'desc')
            ->paginate(20);
    }

    public function show($id)
    {
        return DelayedFeedAssignment::with('user')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'delay_seconds' => 'required|integer|min:0',
            'reason' => 'nullable|string',
            'assigned_at' => 'nullable|date',
            'active' => 'boolean'
        ]);

        $item = DelayedFeedAssignment::create($data);

        return response()->json([
            'status' => 'ok',
            'assignment' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = DelayedFeedAssignment::findOrFail($id);

        $data = $request->validate([
            'delay_seconds' => 'integer|min:0',
            'reason' => 'nullable|string',
            'assigned_at' => 'nullable|date',
            'active' => 'boolean'
        ]);

        $item->update($data);

        return response()->json(['status' => 'updated', 'item' => $item]);
    }
}
