<?php

namespace App\Http\Controllers\Api;

use App\Actions\SanctumBroadcastingAuthAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Pusher\Pusher;

class SanctumBroadcastingAuthController extends Controller
{
    public $pusherSanctumBroadcaster;

    public function __construct()
    {
        $this->pusherSanctumBroadcaster = Broadcast::driver('pusher-sanctum');
        // $this->sanctumBroadcastingAuthAction = new SanctumBroadcastingAuthAction(new Pusher(
        //     config("broadcasting.connections.pusher.key"),
        //     config("broadcasting.connections.pusher.secret"),
        //     config("broadcasting.connections.pusher.app_id"),
        //     config("broadcasting.connections.pusher.options")
        // ));
    }

    public function handle(Request $request)
    {
        return $this->pusherSanctumBroadcaster->auth($request);
    }
}
