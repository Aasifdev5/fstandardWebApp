<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FundingPlan;
use App\Models\PlanPurchase;
use App\Models\User;
use Illuminate\Http\Request;
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

        // DUMMY RAZORPAY MODE (FOR TESTING WITHOUT CREDENTIALS)
        if ($request->gateway === 'razorpay' && config('app.env') !== 'production') {
            // Simulate successful payment instantly
            $purchase->update([
                'status'             => 'pending',
                'gateway_order_id'   => 'order_dummy_' . $purchase->id,
                'gateway_payment_id' => 'pay_dummy_' . $purchase->id,
                'gateway_response'   => json_encode(['simulated' => true, 'message' => 'Test payment success']),
            ]);

            return redirect()->route('payment.success')
                ->with('success', 'Test Payment Successful! (Dummy Mode)');
        }

        // Real flow for PhonePe & PayPal (or when in production)
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
