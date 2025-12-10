<?php

namespace App\Http\Controllers;

use App\Models\BlockchainHashRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BlockchainHashRecordController extends Controller
{
    public function index(Request $request)
    {
        if (!Session::has('LoggedIn')) {
            return redirect()->route('login');
        }

        $records = BlockchainHashRecord::with('user')
            ->orderBy('for_date', 'desc')
            ->paginate(50);
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        return view('admin.blockchain-hash-records.index', compact('records','user_session'));
    }

    public function show($id)
    {
        if (!Session::has('LoggedIn')) {
            return redirect()->route('login');
        }
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $record = BlockchainHashRecord::with('user')->findOrFail($id);
        return view('admin.blockchain-hash-records.show', compact('record', 'user_session'));
    }

    public function destroy($id)
    {
        if (!Session::has('LoggedIn')) {
            return response()->json(['success' => false], 401);
        }

        BlockchainHashRecord::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function bulkDelete(Request $request)
    {
        if (!Session::has('LoggedIn')) {
            return response()->json(['success' => false], 401);
        }

        $ids = $request->input('ids', []);
        BlockchainHashRecord::whereIn('id', $ids)->delete();

        return response()->json(['success' => true]);
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
