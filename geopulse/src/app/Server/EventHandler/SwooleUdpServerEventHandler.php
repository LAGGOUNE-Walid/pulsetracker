<?php

namespace Pulse\Server\EventHandler;

use Pulse\Contracts\PacketParser\Packet;
use Pulse\Services\BroadcastPacketService;
use Swoole\Coroutine as Co;
use Swoole\Server;
use Swoole\Server\Task;
use Swoole\Table;

class SwooleUdpServerEventHandler
{
    public function __construct(
        private Packet $udpPacketParser,
        private BroadcastPacketService $broadcastPacketService,
        private Table $appsDevicesTable,
        private Table $usersQuotaTable
    ) {}

    public function onPacket(Server $server, string $data, $clientInfo): bool
    {
        // Read and unpack the message if it is compressed with msgpack
        // This uses the udpPacketParser service to deserialize the incoming UDP packet data
        $packet = $this->udpPacketParser->fromString($data, $clientInfo['address']);

        if ($packet === null) {
            return false;
        }

        // Verify that the App ID sent from the client matches the server's configured App ID
        // This ensures that only authorized clients can send data to the server
        if (! $this->appsDevicesTable->exists($packet->getAppId())) {
            echo "Not app id in cache \n";
            return false;
        }

        // Verify if the Client ID belongs to this App
        $appDataInCache = $this->appsDevicesTable->get($packet->getAppId());
        $appDevices  = json_decode($appDataInCache['devicesKeys'], true);
        if (! in_array($packet->getClientId(), $appDevices)) {
            echo "Not client id in apps \n";
            return false;
        }

        // Verify if the user has more monthly quota
        if (! $this->usersQuotaTable->exists($appDataInCache['userId'])) {
            echo "Not exists user id in cache \n";
            return false;
        }
        $userQuotaInCache = $this->usersQuotaTable->get($appDataInCache['userId']);
        if (
            $userQuotaInCache['left'] < 0
        ) {
            echo "No left quota in this month \n";
            $server->sendto($clientInfo['address'], $clientInfo['port'], "Server: {$data}");
            return false;
        }
        $this->usersQuotaTable->decr($appDataInCache['userId'], 'left');

        $this->broadcastPacketService->dropAndPopPacket($packet);

        return true;
    }
}
