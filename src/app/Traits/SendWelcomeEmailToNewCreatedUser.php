<?php

namespace App\Traits;

use App\Models\User;
use App\Mail\UserJoined;
use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\Mail;

trait SendWelcomeEmailToNewCreatedUser
{
    public function sendWelcomeEmailToNewCreatedUser(User $user): void
    {
        Mail::to($user)->send(new UserJoined);
    }
}
