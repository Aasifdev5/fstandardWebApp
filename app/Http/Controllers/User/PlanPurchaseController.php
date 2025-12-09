<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FundingPlan;
use App\Models\PlanPurchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Razorpay\Api\Api as RazorpayApi;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PlanPurchaseController extends Controller
{
    // 1. Show Purchase Page
    public function selectPlan($id)
    {
        if (!Session::has('LoggedIn')) {
            return redirect('login')->with('fail', 'Please login first.');
        }

        $user_session = \App\Models\User::find(Session::get('LoggedIn'));
        $plan = FundingPlan::findOrFail($id);

        return view('purchase', compact('plan', 'user_session'));
    }

    // 2. Initiate Payment After Gateway Selection
    public function initiatePayment(Request $request, $Id)
{
    $request->validate([
        'gateway' => 'required|in:razorpay,phonepe,paypal'
    ]);

    $plan = FundingPlan::findOrFail($Id);
    $userId = Session::get('LoggedIn');

    $purchase = PlanPurchase::create([
        'user_id'         => $userId,
        'funding_plan_id' => $plan->id,
        'amount'          => $plan->fee,
        'gateway'         => $request->gateway,
        'status'          => 'pending',
        'transaction_id'  => 'TXN_' . strtoupper(Str::random(12)),
    ]);

    // -------------------------------------------------------------
    // DUMMY RAZORPAY MODE (TEST MODE - NO LIVE API CALL)
    // -------------------------------------------------------------
    if ($request->gateway === 'razorpay' && config('app.env') !== 'production') {

        $purchase->update([
            'status'             => 'pending',
            'gateway_order_id'   => 'order_dummy_' . $purchase->id,
            'gateway_payment_id' => 'pay_dummy_' . $purchase->id,
            'gateway_response'   => json_encode(['simulated' => true, 'message' => 'Test payment success']),
        ]);

        // --------------------------
        // CREATE CHALLENGE DYNAMIC
        // --------------------------

        // Extract percentage numbers (e.g., "8%" → 8)
        $profitTargetPercent = (float) str_replace('%', '', $plan->profit_target);
        $maxLossPercent      = (float) str_replace('%', '', $plan->max_loss);

        // Extract number of trading days (e.g., "20 Days" → 20)
        $maxTradingDays = (int) filter_var($plan->payout_cycle, FILTER_SANITIZE_NUMBER_INT);

        // Dynamic Calculations
        $startingBalance      = $plan->capital;
        $profitTargetAmount   = $startingBalance * ($profitTargetPercent / 100);
        $maxDailyLossAmount   = $startingBalance * ($maxLossPercent / 100);
        $maxOverallLossAmount = $startingBalance * ($maxLossPercent / 100);

        // Insert Challenge Dynamically
        DB::table('challenges')->insert([
            'user_id'                     => $userId,
            'plan_id'                     => $plan->id,

            // Balances
            'capacity_value'              => $startingBalance,
            'start_balance'               => $startingBalance,
            'current_balance'             => $startingBalance,
            'peak_balance'                => $startingBalance,

            // P/L
            'total_profit'                => 0,
            'total_loss'                  => 0,

            // Drawdowns
            'daily_drawdown'              => 0,
            'overall_drawdown'            => 0,

            'phase'                       => 1,
            'status'                      => 'active',

            // Trading days
            'min_days_required'           => 5,
            'valid_days_completed_days'   => 0,
            'max_trading_days'            => $maxTradingDays ?: null,
            'trading_days_elapsed'        => 0,

            // Risk rules
            'profit_target_percent'       => $profitTargetPercent,
            'max_daily_loss_percent'      => $maxLossPercent,
            'max_overall_loss_percent'    => $maxLossPercent,

            // Risk in amounts
            'profit_target_amount'        => $profitTargetAmount,
            'max_daily_loss_amount'       => $maxDailyLossAmount,
            'max_overall_loss_amount'     => $maxOverallLossAmount,

            'current_daily_loss_percent'  => 0,
            'current_overall_loss_percent'=> 0,

            // Payout
            'next_payout_eligible_at'     => null,
            'payout_amount'               => 0,
            'last_payout_at'              => null,

            // Dates
            'started_at'                  => now(),
            'ended_at'                    => null,
            'passed_at'                   => null,
            'failed_at'                   => null,

            // Account ID
            'account_id'                  => 'DEMO-' . strtoupper(Str::random(8)),

            // Plan Rules saved inside meta
            'meta' => json_encode([
                'drawdown_type'     => $plan->drawdown_type,
                'payout_cycle'      => $plan->payout_cycle,
                'news_trading'      => (int) $plan->news_trading,
                'weekend_holding'   => (int) $plan->weekend_holding,
            ]),

            'is_demo'                     => true,
            'created_at'                  => now(),
            'updated_at'                  => now(),
        ]);

        return redirect()->route('payment.success')
            ->with('success', 'Test Payment Successful! Challenge Created.');
    }

    // -------------------------------------------------------------
    // LIVE MODE: PhonePe, Razorpay (Production), PayPal
    // -------------------------------------------------------------
    return match ($request->gateway) {
        'razorpay' => $this->initiateRazorpayPayment($purchase),
        'phonepe'  => $this->initiatePhonePePayment($purchase),
        'paypal'   => $this->initiatePayPalPayment($purchase),
        default    => back()->with('error', 'Invalid payment method'),
    };
}


    // ==================== RAZORPAY ====================
    private function initiateRazorpayPayment($purchase)
    {
        $api = new RazorpayApi(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        $order = $api->order->create([
            'receipt'         => $purchase->transaction_id,
            'amount'          => $purchase->amount * 100,
            'currency'        => 'INR',
            'payment_capture' => 1
        ]);

        $purchase->update(['gateway_order_id' => $order->id]);

        return view('payment.razorpay', compact('purchase', 'order'));
    }

    public function handleRazorpayCallback(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required',
            'razorpay_order_id'   => 'required',
            'razorpay_signature'  => 'required',
        ]);

        $api = new RazorpayApi(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        try {
            // Verify signature - THIS IS CRITICAL FOR SECURITY
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature,
            ]);

            $purchase = PlanPurchase::where('gateway_order_id', $request->razorpay_order_id)->firstOrFail();

            $purchase->update([
                'status'             => 'pending',  // Payment done → admin will approve
                'gateway_payment_id' => $request->razorpay_payment_id,
                'gateway_signature'  => $request->razorpay_signature,
                'gateway_response'   => $request->all(),
            ]);

            return redirect()->route('payment.success')
                ->with('success', 'Payment successful! Your account is under review.');
        } catch (\Exception $e) {
            \Log::error('Razorpay verification failed: ' . $e->getMessage());
            return redirect()->route('payment.failed')->with('error', 'Payment verification failed.');
        }
    }

    // ==================== PHONEPE ====================
    private function initiatePhonePePayment($purchase)
    {
        $payload = [
            "merchantId" => env('PHONEPE_MERCHANT_ID'),
            "merchantTransactionId" => $purchase->transaction_id,
            "merchantUserId" => "MUID{$purchase->user_id}",
            "amount" => $purchase->amount * 100,
            "redirectUrl" => route('payment.callback.phonepe'),
            "redirectMode" => "POST",
            "callbackUrl" => route('payment.callback.phonepe'),
            "mobileNumber" => "9999999999",
            "paymentInstrument" => ["type" => "PAY_PAGE"]
        ];

        $base64 = base64_encode(json_encode($payload));
        $hash = hash('sha256', $base64 . '/pg/v1/pay' . env('PHONEPE_SALT_KEY')) . '###' . env('PHONEPE_SALT_INDEX', 1);

        $purchase->update(['gateway_order_id' => $purchase->transaction_id]);

        return view('payment.phonepe', compact('purchase', 'base64', 'hash'));
    }

    public function handlePhonePeCallback(Request $request)
    {
        // PhonePe sends response in base64 in 'response' param
        if ($request->has('response')) {
            $response = json_decode(base64_decode($request->response), true);

            if (isset($response['success']) && $response['success'] === true && $response['code'] === 'PAYMENT_SUCCESS') {
                $purchase = PlanPurchase::where('transaction_id', $response['data']['merchantTransactionId'])->firstOrFail();

                $purchase->update([
                    'status'            => 'pending',
                    'gateway_payment_id' => $response['data']['transactionId'],
                    'gateway_response'  => $response,
                ]);

                return redirect()->route('payment.success');
            }
        }

        return redirect()->route('payment.failed')->with('error', 'Payment failed or cancelled.');
    }

    // ==================== PAYPAL ====================
    private function initiatePayPalPayment($purchase)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('payment.callback.paypal'),
                "cancel_url" => route('payment.cancel'),
                "brand_name" => config('app.name'),
                "shipping_preference" => "NO_SHIPPING"
            ],
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => "USD",
                    "value" => number_format($purchase->amount, 2, '.', '')
                ],
                "reference_id" => $purchase->transaction_id,
                "description" => "Evaluation Plan Purchase"
            ]]
        ]);

        if (isset($response['id'])) {
            $purchase->update(['gateway_order_id' => $response['id']]);

            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return back()->with('error', 'PayPal unavailable. Try another method.');
    }

    public function handlePayPalCallback(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        try {
            $response = $provider->capturePaymentOrder($request->token);

            if ($response['status'] === 'COMPLETED') {
                $purchase = PlanPurchase::where('gateway_order_id', $response['id'])->firstOrFail();

                $captureId = $response['purchase_units'][0]['payments']['captures'][0]['id'];

                $purchase->update([
                    'status'             => 'pending',
                    'gateway_payment_id' => $captureId,
                    'gateway_response'   => $response,
                ]);

                return redirect()->route('payment.success');
            }
        } catch (\Exception $e) {
            \Log::error('PayPal Error: ' . $e->getMessage());
        }

        return redirect()->route('payment.failed');
    }

    // ==================== STATUS PAGES ====================
    public function paymentSuccess()
{
    // Your custom session check — exactly how you use it everywhere
    if (!Session::has('LoggedIn')) {
        return redirect('Userlogin')->with('fail', 'Please login first.');
    }

    $user_session = User::find(Session::get('LoggedIn'));

    if (!$user_session) {
        return redirect('Userlogin')->with('fail', 'Session expired. Please login again.');
    }

    // Optional: Log in user to Laravel Auth (so auth()->user() works too)
    auth()->login($user_session);

    // Get latest purchase safely
    $latestPurchase = $user_session->purchases()->latest()->first();

    return view('payment.success', compact('user_session', 'latestPurchase'));
}

public function paymentFailed()
{
    if (!Session::has('LoggedIn')) {
        return redirect('Userlogin')->with('fail', 'Please login first.');
    }

    $user_session = User::find(Session::get('LoggedIn'));

    if (!$user_session) {
        return redirect('Userlogin')->with('fail', 'Session expired.');
    }

    auth()->login($user_session);

    return view('payment.failed', compact('user_session'));
}

public function paymentCancel()
{
    if (!Session::has('LoggedIn')) {
        return redirect('Userlogin')->with('fail', 'Please login first.');
    }

    $user_session = User::find(Session::get('LoggedIn'));

    if (!$user_session) {
        return redirect('Userlogin')->with('fail', 'Session expired.');
    }

    auth()->login($user_session);

    return view('payment.cancel', compact('user_session'));
}
}
