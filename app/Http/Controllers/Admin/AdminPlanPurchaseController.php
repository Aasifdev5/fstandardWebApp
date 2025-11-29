<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PlanApprovedMail;
use App\Mail\PlanRejectedMail;
use App\Models\PlanPurchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminPlanPurchaseController extends Controller
{
    public function index()
    {
        if (!Session::has('LoggedIn')) {
            return redirect('Userlogin')->with('fail', 'Please login first.');
        }

        $user_session = User::find(Session::get('LoggedIn'));

        $purchases = PlanPurchase::with(['user', 'plan'])
    ->orderByRaw("FIELD(status, 'pending', 'completed', 'approved', 'rejected')")
    ->orderBy('created_at', 'desc')
    ->get(); // <-- execute query

// dd($purchases);


        return view('admin.plan-purchases.index', compact('purchases', 'user_session'));
    }

    public function show($id)
    {
        if (!Session::has('LoggedIn')) {
            return redirect('Userlogin')->with('fail', 'Please login first.');
        }

        $user_session = User::find(Session::get('LoggedIn'));
        $purchase = PlanPurchase::with(['user', 'plan'])->findOrFail($id);
        return view('admin.plan-purchases.show', compact('purchase','user_session'));
    }

    public function approve(Request $request, $id)
    {
        $purchase = PlanPurchase::findOrFail($id);

        // Prevent double approval
        if (in_array($purchase->status, ['approved', 'rejected'])) {
            return back()->with('error', 'This purchase has already been processed.');
        }

        // Generate unique MT4/MT5 login (8000000 – 8999999)
        do {
            $mt4_login = rand(8000000, 8999999);
        } while (PlanPurchase::where('mt4_login', $mt4_login)->exists());

        $mt4_password = Str::random(10);

        // Save login details directly in plan_purchases table
        $purchase->update([
            'status'        => 'approved',
            'mt4_login'     => $mt4_login,
            'mt4_password'  => $mt4_password,
            'mt4_server'    => 'YourBroker-Live', // Change to your broker server name
            'approved_by'   => Session::get('LoggedIn'),
            'approved_at'   => now(),
            'notes'         => $request->notes,
        ]);

        // Send email with login credentials
        try {
            Mail::to($purchase->user->email)->send(new PlanApprovedMail($purchase));
        } catch (\Exception $e) {
            \Log::error('Approval email failed: ' . $e->getMessage());
        }

        return back()->with('success', "Approved successfully! MT4 Login: {$mt4_login} sent to user.");
    }

    public function reject(Request $request, $id)
    {
        $purchase = PlanPurchase::findOrFail($id);

        if (in_array($purchase->status, ['approved', 'rejected'])) {
            return back()->with('error', 'Already processed.');
        }

        $purchase->update([
            'status'      => 'rejected',
            'approved_by' => Session::get('LoggedIn'),
            'approved_at' => now(),
            'notes'       => $request->notes,
        ]);

        try {
            Mail::to($purchase->user->email)->send(new PlanRejectedMail($purchase));
        } catch (\Exception $e) {
            \Log::error('Reject email failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Purchase rejected and user notified.');
    }

    public function bulkAction(Request $request)
    {
        $ids = $request->input('ids', []);
        $action = $request->input('action');

        if (empty($ids) || !in_array($action, ['approve', 'reject'])) {
            return back()->with('error', 'Invalid bulk action.');
        }

        $purchases = PlanPurchase::whereIn('id', $ids)
            ->whereNotIn('status', ['approved', 'rejected'])
            ->get();

        foreach ($purchases as $purchase) {
            if ($action === 'approve') {
                $this->approve($request, $purchase->id); // Reuse logic
            } else {
                $this->reject($request, $purchase->id);
            }
        }

        return back()->with('success', 'Bulk action completed!');
    }
}
