<?php

namespace Pulse\Server\Custom;

use Pulse\Contracts\Server\CustomServerContract;
use Pulse\Contracts\Server\EventsHandler;
use Pulse\Contracts\Server\WsEventsHandler;
use Swoole\WebSocket\Server;

class WsServer extends CustomServerContract
{
    public function create(): WsServer
    {

        $this->server = new Server(
            $this->address,
            $this->port,
        );

        return $this;
    }

    public function setEventsHandler(EventsHandler $eventsHandler): WsServer
    {
        if (! $eventsHandler instanceof WsEventsHandler) {
            throw new \InvalidArgumentException('Handler must implement WsEventsHandler');
        }

        $this->server->on('Open', [$eventsHandler, 'onOpen']);
        $this->server->on('Message', [$eventsHandler, 'onMessage']);
        $this->server->on('Close', [$eventsHandler, 'onClose']);

        return $this;
    }
}
