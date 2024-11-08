<?php

namespace App\Http\Controllers\Api;

use App\Actions\PusherSanctumBroadcaster;
use App\Actions\SanctumBroadcastingAuthAction;
use Pusher\Pusher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Broadcasting\Broadcasters\Broadcaster;
use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
use Illuminate\Broadcasting\Broadcasters\UsePusherChannelConventions;
use Illuminate\Support\Facades\Broadcast;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

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
