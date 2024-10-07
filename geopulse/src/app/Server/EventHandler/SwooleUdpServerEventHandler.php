<?php

namespace Pulse\Server\EventHandler;

use Swoole\Table;
use Swoole\Server;
use Monolog\Logger;
use Pulse\Contracts\PacketParser\Packet;
use Pulse\Services\BroadcastPacketService;

class SwooleUdpServerEventHandler
{
    public function __construct(
        private Packet $udpPacketParser,
        private BroadcastPacketService $broadcastPacketService,
        private Table $appsDevicesTable,
        private Table $usersQuotaTable,
        private Logger $logger
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
            $this->logger->notice('Could not find in table app id '.$packet->getAppId());
            return false;
        }

        // Verify if the Client ID belongs to this App
        $appDataInCache = $this->appsDevicesTable->get($packet->getAppId());
        $appDevices = json_decode($appDataInCache['devicesKeys'], true);
        if (! in_array($packet->getClientId(), $appDevices)) {
            $this->logger->notice('Could not find device id '.$packet->getClientId());
            return false;
        }

        // Verify if the user has more monthly quota
        if (! $this->usersQuotaTable->exists($appDataInCache['userId'])) {
            $this->logger->notice('Could not user id '.$appDataInCache['userId']);
            return false;
        }
        $userQuotaInCache = $this->usersQuotaTable->get($appDataInCache['userId']);
        if (
            $userQuotaInCache['left'] < 0
        ) {
            // echo "No left quota in this month \n";
            $server->sendto($clientInfo['address'], $clientInfo['port'], 'ERR_QUOTA');
            $this->logger->notice('User id '.$appDataInCache['userId'].' quota exceeded');
            return false;
        }
        $this->usersQuotaTable->decr($appDataInCache['userId'], 'left');
        $this->broadcastPacketService->dropAndPopPacket($packet);

        return true;
    }
}
