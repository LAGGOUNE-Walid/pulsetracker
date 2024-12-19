<?php

namespace Pulse\Server\Custom;

use Pulse\Contracts\Server\CustomServerContract;
use Pulse\Contracts\Server\EventsHandler;
use Pulse\Contracts\Server\UdpEventsHandler;
use Swoole\Server;

class UdpServer extends CustomServerContract
{
    public function create(): UdpServer
    {

        $this->server = new Server(
            $this->address,
            $this->port,
            SWOOLE_PROCESS,
            SWOOLE_SOCK_UDP
        );

        return $this;
    }

    public function setEventsHandler(EventsHandler $eventsHandler): UdpServer
    {
        if (! $eventsHandler instanceof UdpEventsHandler) {
            throw new \InvalidArgumentException('Handler must implement UdpEventsHandler');
        }
        $this->server->on('Packet', [$eventsHandler, 'onPacket']);

        return $this;
    }
}
