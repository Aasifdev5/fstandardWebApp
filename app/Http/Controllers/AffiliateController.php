<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AffiliateController extends Controller
{
    public function affiliate()
    {
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        return view('affiliate', compact('user_session'));
    }

    // Register
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:affiliates,email',
            'terms'      => 'required',
        ]);

        $affiliate = Affiliate::create([
            'first_name'      => $request->first_name,
            'last_name'       => $request->last_name,
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'commission_rate' => 18.00,
        ]);

        // Store affiliate ID in session
        Session::put('affiliate_id', $affiliate->id);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'redirect' => route('affiliate.dashboard')
            ]);
        }

        return redirect()->route('affiliate.dashboard');
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $affiliate = Affiliate::where('email', $request->email)->first();

        if (!$affiliate || !Hash::check($request->password, $affiliate->password)) {
            $error = 'Invalid email or password.';

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $error,
                    'errors'  => ['email' => [$error]]
                ], 422);
            }

            return back()->withErrors(['email' => $error])->onlyInput('email');
        }

        // Login successful → Save to session
        Session::put('affiliate_id', $affiliate->id);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'redirect' => route('affiliate.dashboard')
            ]);
        }

        return redirect()->route('affiliate.dashboard');
    }

    // Dashboard
    public function dashboard()
    {
        if (!Session::has('affiliate_id')) {
            return redirect()->route('affiliate');
        }

        $user = Affiliate::find(Session::get('affiliate_id'));

        return view('affiliate.dashboard', compact('user'));
    }

    // Logout
    public function logout(Request $request)
    {
        Session::forget('affiliate_id');
        Session::save();

        return redirect()->route('affiliate');
    }
}
