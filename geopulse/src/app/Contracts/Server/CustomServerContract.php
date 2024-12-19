<?php

namespace Pulse\Contracts\Server;

use Swoole\Server;

abstract class CustomServerContract
{
    protected string $address;

    protected int $port;

    protected $config;

    protected Server $server;

    public function setAddress(string $address): CustomServerContract
    {
        $this->address = $address;

        return $this;
    }

    public function setPort(int $port): CustomServerContract
    {
        $this->port = $port;

        return $this;
    }

    abstract public function create(): CustomServerContract;

    public function setConfig(array $config): CustomServerContract
    {
        $this->server->set($config);

        return $this;
    }

    abstract public function setEventsHandler(EventsHandler $eventHandler): CustomServerContract;

    public function start(): void
    {
        $this->server->start();
    }
}
