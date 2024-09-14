<?php

namespace App\Actions;

use App\Models\User;
use App\Traits\SendWelcomeEmailToNewCreatedUser;

class OauthCreateUserAction
{
    use SendWelcomeEmailToNewCreatedUser;

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

        return $user;
    }
}
