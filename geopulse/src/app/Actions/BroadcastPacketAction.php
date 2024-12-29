<?php

namespace Pulse\Actions;

use Pulse\Contracts\Action\PacketActionContract;
use Pulse\Contracts\PacketParser\Packet;
use Pusher\Pusher;

class BroadcastPacketAction implements PacketActionContract
{
    public function __construct(private Pusher $pusher) {}

    public function handle(Packet $packet): void
    {
        try {
            $this->pusher->trigger('private-apps.'.$packet->getAppId(), 'App\\Events\\DeviceLocationUpdated', [
                'appKey' => $packet->getAppId(),
                'key' => $packet->getClientId(),
                'name' => $packet->getClientId(),
                'location' => $packet->toPoint(),
                'extra' => $packet->getExtraData(),
            ]);
        } catch (\Throwable $th) {
            \Sentry\captureException($th);
        }

    }
}
