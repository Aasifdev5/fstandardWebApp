<?php

namespace App\Http\Controllers;

use App\Models\BlockchainHashRecord;
use Illuminate\Http\Request;

class BlockchainHashRecordController extends Controller
{
    /**
     * List records
     */
    public function index(Request $request)
    {
        return BlockchainHashRecord::with('user')
            ->orderBy('for_date', 'desc')
            ->paginate(20);
    }

    /**
     * Show record
     */
    public function show($id)
    {
        return BlockchainHashRecord::with('user')->findOrFail($id);
    }

    /**
     * Store new hash record (usually system-generated)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'for_date' => 'required|date',
            'chain' => 'nullable|string',
            'tx_hash' => 'nullable|string',
            'behaviour_metrics_hash' => 'required|string',
            'meta' => 'nullable|array'
        ]);

        $record = BlockchainHashRecord::create($data);

        return response()->json([
            'status' => 'ok',
            'record' => $record
        ]);
    }
}
