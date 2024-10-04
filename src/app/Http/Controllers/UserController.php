<?php

namespace App\Http\Controllers;

use App\Actions\ManualCreateUserAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct(
        private ManualCreateUserAction $manualCreateUserAction
    ) {}

    public function create(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
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
}
