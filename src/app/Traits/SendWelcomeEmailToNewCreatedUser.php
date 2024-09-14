<?php

namespace App\Traits;

use App\Mail\UserJoined;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

trait SendWelcomeEmailToNewCreatedUser
{
    public function sendWelcomeEmailToNewCreatedUser(User $user): void
    {
        Mail::to($user)->send(new UserJoined);
    }
}
