<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Raziul\Sslcommerz\Facades\Sslcommerz;

class SubscriptionController extends Controller
{
    // Plan prices — you can adjust these
    protected $plans = [
        'monthly' => ['label' => 'Monthly Plan', 'price' => 199, 'days' => 30],
        'yearly' => ['label' => 'Yearly Plan', 'price' => 1499, 'days' => 365],
    ];

    // Show plans page
    public function plans()
    {
        $plans = $this->plans;
        return view('subscription.plans', compact('plans'));
    }

    // Initiate payment
    public function checkout(Request $request)
    {
        $request->validate(['plan' => 'required|in:monthly,yearly']);

        $planType = $request->plan;
        $planData = $this->plans[$planType];
        $user = Auth::user();

        $invoiceId = 'MCQ-' . strtoupper(Str::random(10));

        // Create a pending subscription + payment record
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'plan_type' => $planType,
            'start_date' => now(),
            'end_date' => now()->addDays($planData['days']),
            'status' => 'expired', // will be activated only after successful payment
        ]);

        $payment = Payment::create([
            'user_id' => $user->id,
            'subscription_id' => $subscription->id,
            'gateway' => 'sslcommerz',
            'amount' => $planData['price'],
            'transaction_id' => $invoiceId,
            'status' => 'pending',
        ]);

        $response = Sslcommerz::setOrder($planData['price'], $invoiceId, $planData['label'])
            ->setCustomer($user->name, $user->email, $user->phone ?? '01700000000')
            ->setShippingInfo(1, 'N/A')
            ->makePayment();

        if ($response->success()) {
            return redirect($response->gatewayPageURL());
        }

        return redirect()->route('subscription.plans')->with('error', 'Failed to initiate payment. Please try again.');
    }

    // Success callback
    public function success(Request $request)
    {
        $transactionId = $request->tran_id ?? $request->input('tran_id');

        $isValid = Sslcommerz::validatePayment($request->all(), $transactionId, $request->amount ?? null);

        if (! $isValid) {
            return redirect()->route('subscription.plans')->with('error', 'Payment validation failed.');
        }

        DB::transaction(function () use ($transactionId, $request) {
            $payment = Payment::where('transaction_id', $transactionId)->first();

            if ($payment && $payment->status !== 'success') {
                $payment->update(['status' => 'success']);

                $subscription = $payment->subscription;
                $subscription->update(['status' => 'active']);

                $user = $payment->user;
                $user->update(['account_type' => 'premium']);
            }
        });

        return redirect()->route('subscription.success');
    }

    // Failure callback
    public function fail(Request $request)
    {
        $transactionId = $request->tran_id ?? $request->input('tran_id');
        Payment::where('transaction_id', $transactionId)->update(['status' => 'failed']);

        return redirect()->route('subscription.plans')->with('error', 'Payment failed. Please try again.');
    }

    // Cancel callback
    public function cancel(Request $request)
    {
        $transactionId = $request->tran_id ?? $request->input('tran_id');
        Payment::where('transaction_id', $transactionId)->update(['status' => 'failed']);

        return redirect()->route('subscription.plans')->with('error', 'Payment was cancelled.');
    }

    // IPN (server-to-server notification) - real-time webhook
    public function ipn(Request $request)
    {
        $transactionId = $request->tran_id ?? $request->input('tran_id');
        $isValid = Sslcommerz::validatePayment($request->all(), $transactionId, $request->amount ?? null);

        if ($isValid) {
            DB::transaction(function () use ($transactionId) {
                $payment = Payment::where('transaction_id', $transactionId)->first();

                if ($payment && $payment->status !== 'success') {
                    $payment->update(['status' => 'success']);

                    $subscription = $payment->subscription;
                    $subscription->update(['status' => 'active']);

                    $user = $payment->user;
                    $user->update(['account_type' => 'premium']);
                }
            });
        }

        return response()->json(['status' => 'ok']);
    }

    public function successPage()
    {
        return view('subscription.success');
    }
}