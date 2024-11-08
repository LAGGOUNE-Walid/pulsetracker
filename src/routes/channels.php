<?php

use App\Models\App;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('apps.{appKey}', function (User $user, string $appKey) {
    return $user->id === App::where('key', $appKey)->first()?->user_id;
});

Broadcast::driver("pusher-sanctum")->channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::driver("pusher-sanctum")->channel('apps.{appKey}', function (User $user, string $appKey) {
    return $user->id === App::where('key', $appKey)->first()?->user_id;
});
