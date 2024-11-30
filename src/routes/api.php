<?php

use App\Http\Controllers\Api\AppController;
use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\DeviceLocationController;
use App\Http\Controllers\Api\DeviceTypeController;
use App\Http\Controllers\Api\SanctumBroadcastingAuthController;
use App\Http\Resources\UserQuotaResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users/quota', function (Request $request) {
    $request->validate(['ids' => 'required']);

    return UserQuotaResource::collection(User::withWhereHas(
        'currentUsage'
    )->find($request->ids));
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('apps', AppController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'delete',
    ]);
    Route::resource('devices', DeviceController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'delete',
    ]);
    Route::resource('devices.locations', DeviceLocationController::class)->only([
        'index',
    ]);
    Route::get('device_types', [DeviceTypeController::class, 'index']);
    Route::post('broadcasting/auth', [SanctumBroadcastingAuthController::class, 'handle']);
});
