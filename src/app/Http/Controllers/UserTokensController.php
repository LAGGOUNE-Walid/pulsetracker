<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserTokensController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $user->load(['tokens' => function($query) {
            return $query->orderByDesc('id');
        }]);
        return view('dashboard.tokens', ['user' => $user]);
    }
}
