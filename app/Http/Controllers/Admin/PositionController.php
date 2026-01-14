<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trade;
use App\Models\TradeLog;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PositionController extends Controller
{
    protected $dhan;



    public function index()
    {
        if (!Session::has('LoggedIn')) {
            return redirect()->back()->with('fail', 'You must log in first');
        }

        $user_session = User::find(Session::get('LoggedIn'));

        $positions = Trade::where('status', 'OPEN') // 🔥 Ensures CLOSED trades never appear here
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.positions.index', compact('positions', 'user_session'));
    }

    public function history()
    {
        if (!Session::has('LoggedIn')) {
            return redirect()->back()->with('fail', 'You must log in first');
        }

        $user_session = User::find(Session::get('LoggedIn'));

        $trades = TradeLog::with('user')
            ->whereNotNull('exit_time')
            ->latest()->get();

        return view('admin.positions.history', compact('trades', 'user_session'));
    }
}
