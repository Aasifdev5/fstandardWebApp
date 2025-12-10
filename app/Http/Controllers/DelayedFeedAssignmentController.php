<?php

namespace App\Http\Controllers;

use App\Models\DelayedFeedAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DelayedFeedAssignmentController extends Controller
{
    public function index()
    {
        if (!Session::has('LoggedIn')) return redirect()->route('login');

        $assignments = DelayedFeedAssignment::with('user')
            ->orderBy('id', 'desc')
            ->paginate(50);
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        return view('admin.delayed-feed-assignments.index', compact('assignments','user_session'));
    }

    public function show($id)
    {
        if (!Session::has('LoggedIn')) return redirect()->route('login');
        $assignment = DelayedFeedAssignment::with('user')->findOrFail($id);
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        return view('admin.delayed-feed-assignments.show', compact('assignment','user_session'));
    }

    public function destroy($id)
    {
        if (!Session::has('LoggedIn')) return response()->json(['success' => false], 401);
        DelayedFeedAssignment::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function bulkDelete(Request $request)
    {
        if (!Session::has('LoggedIn')) return response()->json(['success' => false], 401);
        $ids = $request->input('ids', []);
        DelayedFeedAssignment::whereIn('id', $ids)->delete();
        return response()->json(['success' => true]);
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
