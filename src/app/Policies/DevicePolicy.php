<?php

namespace App\Policies;

use App\Models\User;

class DevicePolicy
{
    public function create(User $user): bool
    {
        $subscriptions = config('paddle-subscriptions.plans');
        foreach ($subscriptions as $subscription) {
            $allowedDevicesPerSubscription = $subscription['size']['devices'] ?? PHP_INT_MAX;
            if ($user->subscribed($subscription['name']) and $user->devices()->count() < $allowedDevicesPerSubscription) {
                return true;
            }
        }

        return $user->devices()->count() < $subscriptions['free']['size']['devices'];
    }
}
