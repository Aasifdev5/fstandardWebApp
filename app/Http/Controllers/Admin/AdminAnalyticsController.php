<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminCycleForecast;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AdminAnalyticsController extends Controller
{
    public function index()
    {
        if (!Session::has('LoggedIn')) {
            return redirect('Userlogin')->with('fail', 'Please login first.');
        }

        $user_session = User::findOrFail(Session::get('LoggedIn'));
        $latest = AdminCycleForecast::latest('generated_at')->first();
        $history = AdminCycleForecast::orderByDesc('generated_at')->get();

        return view('admin.analytics.index', compact('latest', 'history','user_session'));
    }
}
