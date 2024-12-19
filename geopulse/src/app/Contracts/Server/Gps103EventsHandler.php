<?php

namespace Pulse\Contracts\Server;

use Pulse\Contracts\PacketParser\Packet;
use Swoole\Server;

interface Gps103EventsHandler extends EventsHandler
{
    public function onReceive($server, int $fd, int $reactor_id, string $data): bool;

    public function handleLogin(Packet $packet, $server, int $fd): bool;

    public function handleHeartBeat(Packet $packet, $server, int $fd): bool;

    public function handlePosition(Packet $packet, $server, int $fd): bool;

    public function onClose(Server $server, int $fd): void;
}
