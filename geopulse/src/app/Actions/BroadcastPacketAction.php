<?php

namespace Pulse\Actions;

use Pusher\Pusher;
use Pulse\Contracts\PacketParser\Packet;
use Pulse\Contracts\Action\PacketActionContract;

class BroadcastPacketAction implements PacketActionContract
{
    public function __construct(private Pusher $pusher) {}

    public function handle(Packet $packet): void
    {
        $this->pusher->trigger('private-apps.' . $packet->getAppId(), 'App\\Events\\DeviceLocationUpdated', [
            'appKey' => $packet->getAppId(),
            'key' => $packet->getClientId(),
            'name' => $packet->getClientId(),
            'ip' => $packet->getIp(),
            'location' => $packet->toPoint()
        ]);
    }
}
