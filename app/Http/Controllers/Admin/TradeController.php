<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TradeLog;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    public function index()
    {
        if (!Session::has('LoggedIn')) {
            return redirect()->back()->with('fail', 'You must log in first');
        }

        $user_session = User::find(Session::get('LoggedIn'));

        $trades = TradeLog::with('user', 'challenge.plan')
            ->whereNotNull('exit_time')
            ->latest('exit_time')
            ->paginate(50);

        return view('admin.trades.index', compact('trades', 'user_session'));
    }
}
