<?php

namespace App\Actions;

use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;

class PusherSanctumBroadcaster extends PusherBroadcaster
{
    public function retrieveUser($request, $channel)
    {
        return $request->user();
    }
}
