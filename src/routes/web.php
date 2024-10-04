<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LoginWithProvider;
use App\Http\Controllers\MapController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSubscriptionController;
use App\Http\Middleware\UserCanAccessLocationsHistory;
use App\Mail\EmailVerify;
use App\Models\App;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::GET('/', [UserSubscriptionController::class, 'showHomePage']);
Route::GET('/terms-of-use', function() {
    return view('terms-of-use');
});
Route::GET('/privacy-policy', function() {
    return view('privacy-policy');
});
Route::GET('/subscribe-plan-to-free', [UserSubscriptionController::class, 'moveToFree'])->middleware('auth');
Route::POST('subscription-cancel/{type}', [UserSubscriptionController::class, 'cancel'])->middleware('auth');
Route::POST('subscription-resume/{type}', [UserSubscriptionController::class, 'cancel'])->middleware('auth');
Route::POST('subscription-swap/{type}', [UserSubscriptionController::class, 'swap'])->middleware('auth');

Route::GET('/signup', function () {
    return view('signup');
})->middleware('guest');

Route::GET('/signin', function () {
    return view('signin');
})->middleware('guest')->name('login');

Route::POST('account/create', [UserController::class, 'create'])->middleware('guest');
Route::POST('account/login', [UserController::class, 'login'])->middleware('guest');

Route::GET('login/{provider}', [LoginWithProvider::class, 'redirectToProvider'])->middleware('guest');
Route::GET('{provider}/callback', [LoginWithProvider::class, 'handleProviderCallback'])->middleware('guest');

Route::GET('email-verify/{user}', function (Request $request, User $user) {
    if (! $request->hasValidSignature()) {
        abort(401);
    }
    Auth::login($user);
    $user->update(['email_verified_at' => now()]);

    return redirect()->intended(url('dashboard'));
})->name('email-verify');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::GET('/', function (Request $request) {
        $user = $request->user();
        $user->loadCount([
            'apps',
            'devices',
            'locationsCounts' => function ($query) {
                return $query->where('year', now()->year)->where('month', now()->month);
            },
        ]);

        return view('dashboard.index', ['user' => $user]);
    });
    Route::POST('/logout', function (Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    });
    Route::GET('/send-now-verification', function (Request $request) {
        if ($request->user()->email_verified_at) {
            return redirect()->back();
        }
        $lastmailSent = session('user-sent-mail-'.$request->user()->id, now());
        if ($lastmailSent->diffInMinutes(now()) > 10) {
            Mail::to($request->user())->send(new EmailVerify(URL::temporarySignedRoute('email-verify', now()->addHours(24), ['user' => $request->user()])));
            session(['user-sent-mail-'.$request->user()->id => now()]);
        }

        return redirect()->back();
    });
    Route::group(['prefix' => 'settings'], function () {
        Route::GET('/', function (Request $request) {
            sleep(2);
            $user = $request->user();
            $user->loadCount([
                'apps',
                'devices',
                'locationsCounts' => function ($query) {
                    return $query->where('year', now()->year)->where('month', now()->month);
                },
                'tokens',
            ]);

            return view('dashboard.settings.index', ['user' => $user]);
        })->name('settings');
        Route::POST('/update', [UserController::class, 'update']);
        Route::POST('create-token', [UserController::class, 'createToken']);
        Route::POST('delete-token', [UserController::class, 'deleteToken']);
    });
    Route::group(['prefix' => 'apps'], function () {
        Route::GET('/', [AppController::class, 'index']);
        Route::GET('/create', fn () => view('dashboard.apps.create'));
        Route::POST('/create', [AppController::class, 'create'])->can('create', App::class);
    });
    Route::group(['prefix' => 'devices'], function () {
        Route::GET('/', [DeviceController::class, 'index']);
        Route::GET('/create', [DeviceController::class, 'showCreate']);
        Route::GET('/{key}', [DeviceController::class, 'get']);
        Route::GET('/{key}/{date}', [LocationController::class, 'getByDate'])->middleware(UserCanAccessLocationsHistory::class);

        Route::POST('/create', [DeviceController::class, 'create']);
    });
    Route::group(['prefix' => 'map'], function () {
        Route::GET('/', function (Request $request) {
            return view('dashboard.map.index', ['apps' => $request->user()->apps]);
        });
        Route::GET('/{appKey}', [MapController::class, 'show']);
    });
    Route::POST("feedback", function(Request $request) {
        $request->validate([
            'message' => ['required'],
            'feedbackType' => ['required']
        ]);
        Feedback::create([
            'message' => $request->message,
            'feedbackType' => $request->feedbackType,
            'user_id' => $request->user()->id
        ]);
        return $request->all();
    });
});

