<?php

namespace Pulse\Server\EventHandler;

use Monolog\Logger;
use Pulse\Contracts\PacketParser\Packet;
use Pulse\Contracts\Server\UdpEventsHandler;
use Pulse\Services\BroadcastPacketService;
use Swoole\Server;
use Swoole\Table;

class SwooleUdpServerEventHandler implements UdpEventsHandler
{
    public function __construct(
        private Packet $udpPacketParser,
        private BroadcastPacketService $broadcastPacketService,
        private Table $appsDevicesTable,
        private Table $usersQuotaTable,
        private Table $deviceAppsTable,
        private Logger $logger
    ) {}

    public function onPacket(Server $server, string $data, $clientInfo): bool
    {
        echo $data."\n";
        $packet = $this->udpPacketParser->fromString($data);

        if ($packet === null) {
            return false;
        }

        if ($packet->getAppId()) {
            if (! $this->appsDevicesTable->exists($packet->getAppId())) {
                $this->logger->notice('Could not find in table app id ' . $packet->getAppId());
                return false;
            }
            $appDataInCache = $this->appsDevicesTable->get($packet->getAppId());
            $appDevices = json_decode($appDataInCache['devicesKeys'], true);
            if (! in_array($packet->getClientId(), $appDevices)) {
                $this->logger->notice('Could not find device id ' . $packet->getClientId());
                return false;
            }
            $userId = $appDataInCache['userId'];
        } else {
            if (! $this->deviceAppsTable->exists($packet->getClientId())) {
                $this->logger->notice('Could not find device in devices table ' . $packet->getClientId());
                return false;
            }
            $deviceData = $this->deviceAppsTable->get($packet->getClientId());
            $packet->setAppId($deviceData['appKey']);
            if (! $this->appsDevicesTable->exists($packet->getAppId())) {
                $this->logger->notice('Could not find in table app id ' . $packet->getAppId());
                return false;
            }
            $userId = $deviceData['userId'];
        }

        if (! $this->usersQuotaTable->exists($userId)) {
            $this->logger->notice('Could not user id ' . $appDataInCache['userId']);
            return false;
        }
        // $userQuotaInCache = $this->usersQuotaTable->get($appDataInCache['userId']);
        // if (
        //     $userQuotaInCache['left'] < 0
        // ) {
        //     // echo "No left quota in this month \n";
        //     $server->sendto($clientInfo['address'], $clientInfo['port'], 'ERR_QUOTA');

        //     return false;
        // }
        // if ($userQuotaInCache['left'] === 0) {
        //     $this->logger->notice('User id '.$appDataInCache['userId'].' quota exceeded');
        // }
        // $this->usersQuotaTable->decr($appDataInCache['userId'], 'left');
        $this->broadcastPacketService->dropAndPopPacket($packet);

        return true;
    }
}
