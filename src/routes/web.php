<?php

use App\Http\Controllers\AppController;
use App\Models\User;
use App\Mail\EmailVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginWithProvider;
use App\Http\Controllers\UserSubscriptionController;

Route::get('/', [UserSubscriptionController::class, 'showHomePage']);
Route::get('/subscribe-plan-to-free', [UserSubscriptionController::class, 'moveToFree'])->middleware("auth");

Route::get('/signup', function () {
    return view('signup');
})->middleware('guest');

Route::get('/signin', function () {
    return view('signin');
})->middleware('guest')->name('login');

Route::post('account/create', [UserController::class, 'create'])->middleware('guest');
Route::post('account/login', [UserController::class, 'login'])->middleware('guest');

Route::get('login/{provider}', [LoginWithProvider::class, 'redirectToProvider'])->middleware('guest');
Route::get('{provider}/callback', [LoginWithProvider::class, 'handleProviderCallback'])->middleware('guest');

Route::get('email-verify/{user}', function (Request $request, User $user) {
    if (! $request->hasValidSignature()) {
        abort(401);
    }
    Auth::login($user);
    $user->update(['email_verified_at' => now()]);

    return redirect()->intended(url('dashboard'));
})->name('email-verify');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::GET('/', fn() => view('dashboard.index'));
    Route::GET('/send-now-verification', function (Request $request) {
        if ($request->user()->email_verified_at) {
            return redirect()->back();
        }
        $lastmailSent = session('user-sent-mail-' . $request->user()->id, now());
        if ($lastmailSent->diffInMinutes(now()) > 10) {
            Mail::to($request->user())->send(new EmailVerify(URL::temporarySignedRoute('email-verify', now()->addHours(24), ['user' => $request->user()])));
            session(['user-sent-mail-' . $request->user()->id => now()]);
        }

        return redirect()->back();
    });
    Route::group(['prefix' => 'settings'], function () {
        Route::GET("/", fn() => view('dashboard.settings.index'))->name("settings");
        Route::POST("/update", [UserController::class, 'update']);
    });
    Route::group(['prefix' => 'apps'], function () {
        Route::GET("/", [AppController::class, 'index']);
        Route::GET("/create", fn() => view("dashboard.apps.create"))->can('create', 'app');
        Route::POST("/create", [AppController::class, 'create'])->can('create', 'app');
    });
});
