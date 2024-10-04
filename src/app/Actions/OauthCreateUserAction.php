<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Traits\HaveToCreateCurrentUsageQuota;
use App\Traits\HaveToInitTheFreeSubscription;
use App\Traits\SendWelcomeEmailToNewCreatedUser;

class OauthCreateUserAction
{
    use HaveToCreateCurrentUsageQuota,
        HaveToInitTheFreeSubscription,
        SendWelcomeEmailToNewCreatedUser;

    public function create($userData, string $provider): User
    {
        $user = User::create([
            'name' => $userData->name,
            'email' => $userData->email,
            'provider' => $provider,
            'provider_id' => $userData->id,
            'email_verified_at' => now(),
        ]);

        $this->sendWelcomeEmailToNewCreatedUser($user);
        $this->createCurrentUsageQuota($user);
        $this->initFreeSubscription($user);

        Log::info("User created $user->email");

        return $user;
    }
}
