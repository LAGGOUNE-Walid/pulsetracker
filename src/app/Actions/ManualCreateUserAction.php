<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Traits\HaveToCreateCurrentUsageQuota;
use App\Traits\HaveToInitTheFreeSubscription;
use App\Traits\SendEmailVerificationLinkTrait;
use App\Traits\SendWelcomeEmailToNewCreatedUser;

class ManualCreateUserAction
{
    use HaveToCreateCurrentUsageQuota,
        HaveToInitTheFreeSubscription,
        SendEmailVerificationLinkTrait,
        SendWelcomeEmailToNewCreatedUser;

    public function create(array $credentials): User
    {
        $user = User::create($credentials);

        $this->sendWelcomeEmailToNewCreatedUser($user);
        $this->sendEmailVerificationLink($user);
        $this->createCurrentUsageQuota($user);
        $this->initFreeSubscription($user);

        Log::info("User created $user->email");

        return $user;
    }
}
