<?php

namespace Pulse\Contracts\Server;

use Swoole\Server;

interface UdpEventsHandler extends EventsHandler
{
    public function onPacket(Server $server, string $data, $clientInfo): bool;
}
