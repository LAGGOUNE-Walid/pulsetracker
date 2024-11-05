<?php

namespace App\Policies;

use App\Models\User;

class DevicePolicy
{
    public function create(User $user): bool
    {
        $subscriptions = config('stripe-subscriptions.plans');
        foreach ($subscriptions as $subscription) {
            $allowedDevicesPerSubscription = $subscription['size']['devices'] ?? PHP_INT_MAX;
            if ($user->subscribedToPrice($subscription['price_id'], $subscription['product_id']) and $user->devices()->count() < $allowedDevicesPerSubscription) {
                return $user->hasVerifiedEmail();
            }
        }

        return ($user->devices()->count() < $subscriptions['free']['size']['devices']) and $user->hasVerifiedEmail();
    }
}
