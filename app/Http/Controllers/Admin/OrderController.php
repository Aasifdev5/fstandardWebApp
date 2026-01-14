<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        if (!Session::has('LoggedIn')) {
            return redirect()->back()->with('fail', 'You must log in first');
        }

        $user_session = User::find(Session::get('LoggedIn'));

        $orders = Order::with('user', 'challenge.planPurchase.plan')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders', 'user_session'));
    }

    public function open()
    {
        if (!Session::has('LoggedIn')) {
            return redirect()->back()->with('fail', 'You must log in first');
        }

        $user_session = User::find(Session::get('LoggedIn'));

        $orders = Order::with('user')
            ->where('status', 0) // Open
            ->orWhere('status', 2) // Partial
            ->latest()
            ->get();

        return view('admin.orders.open', compact('orders', 'user_session'));
    }



    public function history()
    {
        if (!Session::has('LoggedIn')) {
            return redirect()->back()->with('fail', 'You must log in first');
        }

        $user_session = User::find(Session::get('LoggedIn'));

        $orders = Order::with('user')
            ->whereIn('status', [1, 9]) // Completed or Cancelled
            ->latest()->get();

        return view('admin.orders.history', compact('orders', 'user_session'));
    }
}
