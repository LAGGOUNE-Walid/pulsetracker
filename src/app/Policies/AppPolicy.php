<?php

namespace App\Policies;

use App\Models\User;
use NunoMaduro\Collision\Adapters\Phpunit\Subscribers\Subscriber;

class AppPolicy
{
    public function create(User $user)
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
