<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\CRUD.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('app', 'AppCrudController');
    Route::crud('app-monthly-quota', 'AppMonthlyQuotaCrudController');
    Route::crud('blog', 'BlogCrudController');
    Route::crud('current-user-subscription', 'CurrentUserSubscriptionCrudController');
    Route::crud('device', 'DeviceCrudController');
    Route::crud('device-last-location', 'DeviceLastLocationCrudController');
    Route::crud('device-location', 'DeviceLocationCrudController');
    Route::crud('device-monthly-quota', 'DeviceMonthlyQuotaCrudController');
    Route::crud('device-type', 'DeviceTypeCrudController');
    Route::crud('feedback', 'FeedbackCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('user-current-quota', 'UserCurrentQuotaCrudController');
    Route::crud('user-monthly-quota', 'UserMonthlyQuotaCrudController');
}); // this should be the absolute last line of this file

/**
 * DO NOT ADD ANYTHING HERE.
 */
