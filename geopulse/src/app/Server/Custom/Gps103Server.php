<?php

namespace Pulse\Server\Custom;

use Pulse\Contracts\Server\CustomServerContract;
use Pulse\Contracts\Server\EventsHandler;
use Pulse\Contracts\Server\Gps103EventsHandler;
use Swoole\Server;

class Gps103Server extends CustomServerContract
{
    protected Server $server;

    public function create(): Gps103Server
    {
        $this->server = new Server(
            $this->address,
            $this->port,
            SWOOLE_PROCESS,
            SWOOLE_SOCK_TCP
        );

        return $this;
    }

    public function setEventsHandler(EventsHandler $eventsHandler): Gps103Server
    {
        if (! $eventsHandler instanceof Gps103EventsHandler) {
            throw new \InvalidArgumentException('Handler must implement Gps103EventsHandler');
        }
        $this->server->on('Receive', [$eventsHandler, 'onReceive']);
        $this->server->on('Close', [$eventsHandler, 'onClose']);

        return $this;
    }
}
