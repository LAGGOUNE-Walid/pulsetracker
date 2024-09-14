<?php

namespace App\Traits;

use App\Mail\EmailVerify;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

trait SendEmailVerificationLinkTrait
{
    public function sendEmailVerificationLink(User $user): void
    {
        Mail::to($user)->send(new EmailVerify(URL::temporarySignedRoute('email-verify', now()->addHours(24), ['user' => $user->id])));
    }
}
