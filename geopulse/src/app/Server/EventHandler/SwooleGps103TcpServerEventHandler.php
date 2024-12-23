<?php

namespace Pulse\Server\EventHandler;

use Monolog\Logger;
use Pulse\Contracts\PacketParser\Packet;
use Pulse\Contracts\Server\Gps103EventsHandler;
use Pulse\Enums\Gps103MessageType;
use Pulse\Services\BroadcastPacketService;
use Swoole\Server;
use Swoole\Table;

class SwooleGps103TcpServerEventHandler implements Gps103EventsHandler
{
    private array $connectedClients;

    private array $connectedClientsFds;

    public function __construct(
        private Packet $gps103PacketParser,
        private BroadcastPacketService $broadcastPacketService,
        private Table $deviceAppsTable,
        private Table $usersQuotaTable,
        private Logger $logger
    ) {}

    public function onReceive($server, int $fd, int $reactor_id, string $data): bool
    {
        $packets = explode(';', $data);
        $data = $packets[0];
        $packet = $this->gps103PacketParser->fromString($data, $server->getClientInfo($fd)['remote_ip']);
        if (! $packet->dataIsValide()) {
            return false;
        }

        return match ($packet->getType()) {
            Gps103MessageType::HEARTBEAT => $this->handleHeartBeat($packet, $server, $fd),
            Gps103MessageType::LOGIN_REQUEST => $this->handleLogin($packet, $server, $fd),
            Gps103MessageType::POSITION_GPS => $this->handlePosition($packet, $server, $fd),
            default => $this->handlePosition($packet, $server, $fd)
        };
    }

    public function handleLogin(Packet $packet, $server, int $fd): bool
    {
        $clientKey = $packet->getClientId();
        if (! $this->deviceAppsTable->exist($clientKey)) {
            return false;
        }
        $clientData = $this->deviceAppsTable->get($clientKey);

        if (! $this->usersQuotaTable->exists($clientData['userId'])) {
            $server->close($fd);
            $this->logger->notice('[GPS 103] Could not find user id '.$clientData['userId']);

            return false;
        }
        $this->connectedClients[$clientKey] = $clientData;
        $this->connectedClientsFds[$fd] = $clientKey;

        return $server->send($fd, 'LOAD');
    }

    public function handleHeartBeat(Packet $packet, $server, int $fd): bool
    {
        return $server->send($fd, 'ON');
    }

    public function handlePosition(Packet $packet, $server, int $fd): bool
    {
        $clientKey = $packet->getClientId();
        if (! array_key_exists($clientKey, $this->connectedClients)) {
            return false;
        }

        $clientData = $this->connectedClients[$clientKey];

        // $userQuotaInCache = $this->usersQuotaTable->get($clientData['userId']);
        // if (
        //     $userQuotaInCache['left'] < 0
        // ) {
        //     $server->close($fd);

        //     return false;
        // }
        // if ($userQuotaInCache['left'] === 0) {
        //     $this->logger->notice('User id '.$clientData['userId'].' quota exceeded');
        // }
        // $this->usersQuotaTable->decr($clientData['userId'], 'left');

        $packet->setAppId($clientData['appKey']);
        $this->broadcastPacketService->dropAndPopPacket($packet);

        return true;
    }

    public function onClose(Server $server, int $fd): void
    {
        if (array_key_exists($fd, $this->connectedClientsFds)) {
            if (array_key_exists($this->connectedClientsFds[$fd], $this->connectedClients)) {
                unset($this->connectedClients[$this->connectedClientsFds[$fd]]);
            }
            unset($this->connectedClientsFds[$fd]);
        }
    }
}
