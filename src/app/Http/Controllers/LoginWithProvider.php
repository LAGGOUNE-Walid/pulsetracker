<?php

namespace App\Http\Controllers;

use App\Actions\OauthCreateUserAction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginWithProvider extends Controller
{
    public function __construct(
        private OauthCreateUserAction $oauthCreateUserAction
    ) {}

    public function redirectToProvider($provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(string $provider): RedirectResponse
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);

        return redirect(url('dashboard'));
    }

    public function findOrCreateUser($user, string $provider): User
    {
        $alreadyExistsUser = User::where('provider_id', $user->id)->first();
        if ($alreadyExistsUser) {
            return $alreadyExistsUser;
        }
        $alreadyExistsUser = User::where('email', $user->email)->first();
        if ($alreadyExistsUser) {
            $alreadyExistsUser->update([
                'name' => $user->name,
                'email' => $user->email,
                'provider' => $provider,
                'provider_id' => $user->id,
            ]);

            return $alreadyExistsUser;
        }

        return $this->oauthCreateUserAction->create($user, $provider);
    }
}
