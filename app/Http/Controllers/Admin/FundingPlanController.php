<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FundingPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FundingPlanController extends Controller
{
    public function index()
    {
        if (!Session::has('LoggedIn')) {
            return redirect('login')->with('fail', 'Please login first.');
        }
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $plans = FundingPlan::orderBy('sort_order')->get();

        return view('admin.funding-plans.index', compact('plans', 'user_session'));
    }

    public function create()
    {
        if (!Session::has('LoggedIn')) {
            return redirect('login')->with('fail', 'Please login first.');
        }
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        return view('admin.funding-plans.create', compact('user_session'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'capital' => 'required|numeric',
            'fee' => 'required|numeric',
            'profit_target' => 'required',
            'max_loss' => 'required',
            'drawdown_type' => 'required',
            'payout_cycle' => 'required',
        ]);

        FundingPlan::create($request->all());

        return redirect()->route('funding-plans.index')
            ->with('success', 'Funding plan created successfully!');
    }

    public function edit($id)
    {
        $plan = FundingPlan::findOrFail($id);
        if (!Session::has('LoggedIn')) {
            return redirect('login')->with('fail', 'Please login first.');
        }
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        return view('admin.funding-plans.edit', compact('plan','user_session'));
    }

    public function update(Request $request, $id)
    {
        $plan = FundingPlan::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:50',
            'capital' => 'required|numeric',
            'fee' => 'required|numeric',
        ]);

        $plan->update($request->all());

        return redirect()->route('funding-plans.index')
            ->with('success', 'Plan updated successfully!');
    }

    public function destroy($id)
    {
        FundingPlan::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids && is_array($ids)) {
            FundingPlan::whereIn('id', $ids)->delete();
        }
        return response()->json(['success' => true]);
    }
}
