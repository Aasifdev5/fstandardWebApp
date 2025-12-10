<?php

namespace App\Http\Controllers;

use App\Models\HedgingMonitor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HedgingMonitorController extends Controller
{
    public function index()
    {
        if (!Session::has('LoggedIn')) return redirect()->route('login');
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $monitors = HedgingMonitor::with(['userA', 'userB'])
            ->orderBy('id', 'desc')
            ->paginate(50);

        return view('admin.hedging-monitor.index', compact('monitors','user_session'));
    }

    public function show($id)
    {
        if (!Session::has('LoggedIn')) return redirect()->route('login');
        $monitor = HedgingMonitor::with(['userA', 'userB'])->findOrFail($id);
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        return view('admin.hedging-monitor.show', compact('monitor','user_session'));
    }

    public function destroy($id)
    {
        if (!Session::has('LoggedIn')) return response()->json(['success' => false], 401);
        HedgingMonitor::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function bulkDelete(Request $request)
    {
        if (!Session::has('LoggedIn')) return response()->json(['success' => false], 401);
        $ids = $request->input('ids', []);
        HedgingMonitor::whereIn('id', $ids)->delete();
        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_a' => 'required|integer',
            'user_b' => 'nullable|integer',
            'triggers' => 'required|array',
            'hedging_score' => 'numeric',
            'action' => 'in:none,alert,fail',
            'evidence' => 'nullable|array'
        ]);

        $monitor = HedgingMonitor::create($data);

        return response()->json([
            'status' => 'ok',
            'record' => $monitor
        ]);
    }

    public function update(Request $request, $id)
    {
        $record = HedgingMonitor::findOrFail($id);

        $data = $request->validate([
            'action' => 'in:none,alert,fail',
            'evidence' => 'nullable|array'
        ]);

        $record->update($data);

        return response()->json(['status' => 'updated', 'record' => $record]);
    }
}
