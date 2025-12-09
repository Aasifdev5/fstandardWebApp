<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TradeLog;
use App\Models\User;
use App\Services\FakeDhanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PositionController extends Controller
{
    protected $dhan;

    public function __construct()
    {
        $this->dhan = app()->environment('local')
            ? new \App\Services\FakeDhanService()
            : app(\App\Services\DhanService::class);
    }

    public function index()
    {
        if (!Session::has('LoggedIn')) {
            return redirect()->back()->with('fail', 'You must log in first');
        }

        $user_session = User::find(Session::get('LoggedIn'));

        $response = $this->dhan->getPositions();
        $positions = $response->successful() ? $response->json() : [];

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
            ->latest()
            ->paginate(50);

        return view('admin.positions.history', compact('trades', 'user_session'));
    }
}
