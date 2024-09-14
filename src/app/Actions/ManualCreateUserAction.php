<?php

namespace App\Actions;

use App\Models\User;
use App\Traits\SendEmailVerificationLinkTrait;
use App\Traits\SendWelcomeEmailToNewCreatedUser;

class ManualCreateUserAction
{
    use SendEmailVerificationLinkTrait, SendWelcomeEmailToNewCreatedUser;

    public function create(array $credentials): User
    {
        $user = User::create($credentials);

        $this->sendWelcomeEmailToNewCreatedUser($user);
        $this->sendEmailVerificationLink($user);

        return $user;
    }
}
