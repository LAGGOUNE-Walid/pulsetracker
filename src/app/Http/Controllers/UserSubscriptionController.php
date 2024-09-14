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
        return view('home', ['checkoutLinks' => $checkoutLinks, "subscriptions" => $subscriptions]);
    }

    public function moveToFree(Request $request): RedirectResponse
    {
        $currentActiveSubscription = $request->user()->subscriptions()->active()->first();
        if ($currentActiveSubscription) {
            $currentActiveSubscription->cancel();
        }
        return redirect(url('dashboard/settings'));
    }
}
