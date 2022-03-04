<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function checkout(Request $request)
    {
        if ($request->user()->subscribed('default')) {
            return redirect()->route('subscriptions.invoices');
        }

        return view('admin.pages.subscriptions.checkout', [
            'intent' => $request->user()->createSetupIntent(),
            'plan' => session('plan') ?? $request->user()->plan()
        ]);
    }
    public function store(Request $request)
    {
        $plan = session('plan') ?? $request->user()->plan();
        $request->user()
                ->newSubscription('default', $plan->stripe_id)
                ->create($request->token);

        return redirect()->route('subscriptions.invoices');
    }

    public function invoices(Request $request)
    {
        $user = $request->user();
        $invoices = $user->invoices();
        $subscription = $user->subscription('default');

        return view('admin.pages.subscriptions.invoices', compact('user', 'invoices','subscription'));
    }

    public function downloadInvoice(Request $request, $invoiceId)
    {
        return $request->user()
                            ->downloadInvoice($invoiceId, [
                                'vendor' => config('app.name'),
                                'product' => 'Assinatura VIP'
                            ]);
    }

    public function cancel(Request $request)
    {
        $request->user()->subscription('default')->cancel();

        return redirect()->route('subscriptions.invoices');
    }

    public function resume(Request $request)
    {
        $request->user()->subscription('default')->resume();

        return redirect()->route('subscriptions.invoices');
    }
}