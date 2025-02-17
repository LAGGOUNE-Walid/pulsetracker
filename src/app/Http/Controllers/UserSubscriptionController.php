<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;

class UserSubscriptionController extends Controller
{
    public function showHomePage(Request $request): View
    {
        if ($request->query('ref')) {
            Cookie::queue(Cookie::forever('referral_ambassador', $request->query('ref')));
        }
        $subscriptions = config('stripe-subscriptions.plans');

        return view('home', ['subscriptions' => $subscriptions]);
    }

    public function subscribe(Request $request, string $plan)
    {
        $subscriptions = config('stripe-subscriptions.plans');
        if (! array_key_exists($plan, $subscriptions)) {
            abort(404);
        }
        $subscription = $subscriptions[$plan];

        $metadata = [];
        if ($request->cookie('referral_ambassador')) {
            $metadata['referral_ambassador'] = $request->cookie('referral_ambassador');
        }

        return $request->user()
            ->newSubscription($subscription['product_id'], $subscription['price_id'])
            ->withMetadata($metadata)
            ->checkout([
                'success_url' => url('dashboard/settings'),
                'cancel_url' => url('/#pricing'),
            ]);
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
        $subscriptions = config('stripe-subscriptions.plans');
        if (! array_key_exists($type, $subscriptions)) {
            abort(404);
        }

        foreach ($subscriptions as $subscription) {
            if ($subscription['product_id'] !== null) {
                if ($request->user()->subscribedToPrice($subscription['price_id'], $subscription['product_id'])) {
                    $request->user()->subscription($subscription['product_id'])->cancel();
                }
            }
        }

        return redirect(url('/#pricing'));
    }

    public function resume(Request $request, string $type): RedirectResponse
    {
        $subscriptions = config('stripe-subscriptions.plans');
        if (! array_key_exists($type, $subscriptions)) {
            abort(404);
        }
        foreach ($subscriptions as $subscription) {
            if ($subscription['product_id'] !== null) {
                if ($request->user()->subscription($subscription['product_id'])->onGracePeriod()) {
                    $request->user()->subscription($subscription['product_id'])->stopCancelation();
                }
            }
        }

        return redirect(url('/#pricing'));
    }

    public function swap(Request $request, string $type)
    {
        $subscriptions = config('stripe-subscriptions.plans');
        if (! array_key_exists($type, $subscriptions)) {
            return abort(404);
        }

        $currentActiveSubscription = $request->user()->subscriptions()->active()->first();
        if (! $currentActiveSubscription) {
            return redirect(url('/#pricing'));
        }

        try {
            $currentActiveSubscription->noProrate()->swapAndInvoice($subscriptions[$type]['price_id']);
        } catch (\Exception $e) {
            return redirect(url('/#pricing'))->withErrors('Failed to swap subscription: '.$e->getMessage());
        }
        $currentActiveSubscription->noProrate()->swapAndInvoice($subscriptions[$type]['price_id']);

        return redirect(url('/#pricing'));

        // exit;
        $currentActiveSubscription = $request->user()->subscriptions()->active()->first();
        $currentActiveSubscription->cancelNow();

        return $request->user()
            ->newSubscription($subscriptions[$type]['product_id'], $subscriptions[$type]['price_id'])
            ->checkout([
                'success_url' => url('dashboard/settings'),
                'cancel_url' => url('/#pricing'),
            ]);
        // $currentActiveSubscription->noProrate()->swapAndInvoice($subscriptions[$type]['price_id']);
        // $request->user()->subscriptions()->active()->first()->update(['type' => $type]);

        return redirect(url('/#pricing'));
    }
}
