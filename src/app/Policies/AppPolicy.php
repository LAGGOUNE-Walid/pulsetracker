<?php

namespace App\Policies;

use App\Models\User;

class AppPolicy
{
    public function create(User $user): bool
    {
        $subscriptions = config('paddle-subscriptions.plans');
        foreach ($subscriptions as $subscription) {
            $allowedAppsPersubsription = $subscription['size']['apps'] ?? PHP_INT_MAX;
            if ($user->subscribed($subscription['name']) and $user->apps()->count() < $allowedAppsPersubsription) {
                return true;
            }
        }

        return $user->apps()->count() < 1;
    }
}
