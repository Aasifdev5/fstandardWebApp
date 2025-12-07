<?php

namespace App\Http\Controllers;

use App\Models\HedgingMonitor;
use Illuminate\Http\Request;

class HedgingMonitorController extends Controller
{
    public function index()
    {
        return HedgingMonitor::with(['userA', 'userB'])
            ->orderBy('id', 'desc')
            ->paginate(20);
    }

    public function show($id)
    {
        return HedgingMonitor::with(['userA', 'userB'])->findOrFail($id);
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
