<?php

namespace Pulse\Server\EventHandler;

use Swoole\Table;
use Monolog\Logger;
use Swoole\Http\Request;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;
use Pulse\Contracts\PacketParser\Packet;
use Pulse\Services\BroadcastPacketService;

class SwooleWsServerEventHandler
{

    private array $clientIps = [];

    public function __construct(
        private Packet $wsPacketParser,
        private BroadcastPacketService $broadcastPacketService,
        private Table $appsDevicesTable,
        private Table $usersQuotaTable,
        private Logger $logger
    ) {}

    public function onOpen(Server $server, Request $request): void
    {
        $real_ip = $request->header['x-forwarded-for'] ?? $server->getClientInfo($request->fd)['remote_ip'];
        $this->clientIps[$request->fd] = $real_ip;
    }

    public function onMessage(Server $ws, Frame $frame): bool
    {
        $packet = $this->wsPacketParser->fromString($frame->data, $this->clientIps[$frame->fd] ?? 'unknown');
        if ($packet === null) {
            $ws->disconnect($frame->fd);
        }
        if (! $this->appsDevicesTable->exists($packet->getAppId())) {
            $ws->disconnect($frame->fd);
            $this->logger->notice('Could not find in table app id ' . $packet->getAppId());
            return false;
        }

        // Verify if the Client ID belongs to this App
        $appDataInCache = $this->appsDevicesTable->get($packet->getAppId());
        $appDevices = json_decode($appDataInCache['devicesKeys'], true);
        if (! in_array($packet->getClientId(), $appDevices)) {
            $ws->disconnect($frame->fd);
            $this->logger->notice('Could not find device id ' . $packet->getClientId());
            return false;
        }

        // Verify if the user has more monthly quota
        if (! $this->usersQuotaTable->exists($appDataInCache['userId'])) {
            $ws->disconnect($frame->fd);
            $this->logger->notice('Could not user id ' . $appDataInCache['userId']);
            return false;
        }
        $userQuotaInCache = $this->usersQuotaTable->get($appDataInCache['userId']);
        if (
            $userQuotaInCache['left'] < 0
        ) {
            // echo "No left quota in this month \n";
            $ws->push($frame->fd, 'ERR_QUOTA');
            $ws->disconnect($frame->fd);
            return false;
        }
        if ($userQuotaInCache['left']  === 0) {
            $this->logger->notice('User id ' . $appDataInCache['userId'] . ' quota exceeded');
        }
        $this->usersQuotaTable->decr($appDataInCache['userId'], 'left');

        $this->broadcastPacketService->dropAndPopPacket($packet);

        return true;
    }

    public function onClose(Server $ws, int $fd): void
    {
        unset($this->clientIps[$fd]);
    }
}
