<?php

namespace Pulse\Server\Custom;

use Pulse\Contracts\Server\CustomServerContract;
use Pulse\Contracts\Server\EventsHandler;
use Pulse\Contracts\Server\RedisEventsHandler;
use Swoole\Redis\Server as SwooleRedisServer;

class RedisServer extends CustomServerContract
{
    public function create(): RedisServer
    {
        $this->server = new SwooleRedisServer($this->address, $this->port, SWOOLE_BASE);

        return $this;
    }

    public function setEventsHandler(EventsHandler $eventsHandler): RedisServer
    {
        if (! $eventsHandler instanceof RedisEventsHandler) {
            throw new \InvalidArgumentException('Handler must implement RedisEventsHandler');
        }
        $eventsHandler->setServer($this->server);
        @$this->server->setHandler('PING', [$eventsHandler, 'ping']);
        @$this->server->setHandler('info', [$eventsHandler, 'emptyResponse']);
        @$this->server->setHandler('GET', [$eventsHandler, 'emptyResponse']);
        @$this->server->setHandler('AUTH', [$eventsHandler, 'emptyResponse']);
        @$this->server->setHandler('SELECT', [$eventsHandler, 'emptyResponse']);
        @$this->server->setHandler('SUBSCRIBE', [$eventsHandler, 'subscribe']);
        $this->server->on('close', [$eventsHandler, 'unsubscribe']);

        return $this;
    }

    public function getServer(): SwooleRedisServer
    {
        return $this->server;
    }
}
