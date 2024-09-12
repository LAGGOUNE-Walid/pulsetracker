<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Actions\CreateUserAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Actions\ManualCreateUserAction;

class UserController extends Controller
{

    public function __construct(
        private ManualCreateUserAction $manualCreateUserAction
    )
    {
        
    } 

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

}
