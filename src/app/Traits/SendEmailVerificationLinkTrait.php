<?php

namespace App\Traits;

use App\Models\User;
use App\Mail\EmailVerify;
use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

trait SendEmailVerificationLinkTrait
{
    public function sendEmailVerificationLink(User $user): void
    {
        Mail::to($user)->send(new EmailVerify(URL::temporarySignedRoute('email-verify', now()->addHours(24), ['user' => $user->id])));
    }
}
