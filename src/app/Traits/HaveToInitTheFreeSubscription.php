<?php

namespace App\Traits;

use App\Models\CurrentUserSubscription;
use App\Models\User;

trait HaveToInitTheFreeSubscription
{
    public function initFreeSubscription(User $user): CurrentUserSubscription
    {
        return $user->currentSubscription()->create([
            'plan' => 'free',
            'starts_at' => now(),
            'ends_at' => now()->addMonth(),
        ]);
    }
}
