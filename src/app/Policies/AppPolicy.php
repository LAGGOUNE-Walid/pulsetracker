<?php

namespace App\Policies;

use App\Models\App;
use App\Models\User;

class AppPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, App $app): bool
    {
        dd('bb');

        return $app->user()->is($user);
    }

    public function create(User $user): bool
    {
        $subscriptions = config('paddle-subscriptions.plans');
        foreach ($subscriptions as $subscription) {
            $allowedAppsPersubsription = $subscription['size']['apps'] ?? PHP_INT_MAX;
            if ($user->subscribed($subscription['name']) and $user->apps()->count() < $allowedAppsPersubsription) {
                return true and $user->hasVerifiedEmail();
            }
        }

        return $user->apps()->count() < 1 and $user->hasVerifiedEmail();
    }

    public function update(User $user, App $app): bool
    {
        return $user->id === $app->user_id;
    }

    public function delete(User $user, App $app): bool
    {
        return $user->id === $app->user_id;
    }
}
