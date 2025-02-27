<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\CloudflareTurnstile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Actions\ManualCreateUserAction;

class UserController extends Controller
{
    public function __construct(
        private ManualCreateUserAction $manualCreateUserAction
    ) {}

    public function create(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required'],
            'cf-turnstile-response' => ['required', 'string', new CloudflareTurnstile()],
        ]);

        $this->manualCreateUserAction->create($credentials);

        $request->session()->regenerate();

        Auth::attempt($credentials, true);

        return redirect()->intended(url('dashboard'));
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(url('dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', Rule::unique('users')->ignore($request->user()->id)],
        ]);
        $request->user()->update(['email' => $request->email]);
        if (
            $request->has('password') and
            $request->password !== '' and
            $request->password !== null
        ) {
            $request->user()->update(['password' => $request->password]);
        }

        return redirect()->back()->with('success', 'Profile updated!');
    }

    public function createToken(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);

        return redirect()->back()->with('createdToken', $request->user()->createToken($request->name)->plainTextToken);
    }

    public function deleteToken(Request $request): RedirectResponse
    {
        $request->validate([
            'token_id' => 'required',
        ]);
        $request->user()->tokens()->where('id', $request->token_id)->delete();

        return redirect()->back();
    }

    public function createSignature(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);

        return redirect()->back()->with('createdSignature', $request->user()->webhookSignature()->create(['name' => $request->name, 'value' => Str::random(32)])->value);
    }

    public function deleteSignature(Request $request): RedirectResponse
    {
        $request->validate([
            'signature_id' => 'required',
        ]);
        $request->user()->webhookSignature()->delete();

        return redirect()->back();
    }
}
