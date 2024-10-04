<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserSubscriptionController extends Controller
{
    public function showHomePage(Request $request): View
    {
        $checkoutLinks = [];
        $subscriptions = config('paddle-subscriptions.plans');
        if ($request->user()) {
            foreach ($subscriptions as $subscription) {
                $checkoutLinks[$subscription['name']] = $request->user()->subscribe($subscription['price_id'], $subscription['name'])
                    ->returnTo(route('settings'));
            }
        }

        return view('home', ['checkoutLinks' => $checkoutLinks, 'subscriptions' => $subscriptions]);
    }

    public function moveToFree(Request $request): RedirectResponse
    {
        $currentActiveSubscription = $request->user()->subscriptions()->active()->first();
        if ($currentActiveSubscription) {
            $currentActiveSubscription->cancel();
        }

        return redirect(url('dashboard/settings'));
    }

    public function cancel(Request $request, string $type): RedirectResponse
    {
        $subscriptions = config('paddle-subscriptions.plans');
        if (! array_key_exists($type, $subscriptions)) {
            abort(404);
        }
        if (! $request->user()->subscribed($type)) {
            return redirect()->back();
        }
        $request->user()->subscription($type)->cancel();

        return redirect(url('/#pricing'));
    }

    public function resume(Request $request, string $type): RedirectResponse
    {
        $subscriptions = config('paddle-subscriptions.plans');
        if (! array_key_exists($type, $subscriptions)) {
            abort(404);
        }
        if (! $request->user()->subscription($type)->onGracePeriod()) {
            return redirect()->back();
        }
        $request->user()->subscription($type)->stopCancelation();

        return redirect(url('/#pricing'));
    }

    public function swap(Request $request, string $type): RedirectResponse
    {
        $subscriptions = config('paddle-subscriptions.plans');
        if (! array_key_exists($type, $subscriptions)) {
            abort(404);
        }
        // exit;
        $currentActiveSubscription = $request->user()->subscriptions()->active()->first();
        $request->user()->subscription($currentActiveSubscription->type)->noProrate()->swapAndInvoice($subscriptions[$type]['price_id']);
        $request->user()->subscriptions()->active()->first()->update(['type' => $type]);

        return redirect(url('/#pricing'));
    }
}
