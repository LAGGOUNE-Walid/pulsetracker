<?php

use App\Http\Resources\UserQuotaResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users/quota', function (Request $request) {
    $request->validate(['ids' => 'required']);

    return UserQuotaResource::collection(User::with([
        'locationsCounts' => function ($query) {
            return $query->where('year', now()->year)->where('month', now()->month);
        },
    ])->find($request->ids));
});
