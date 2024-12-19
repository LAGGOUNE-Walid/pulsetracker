<?php

namespace Pulse\Contracts\Server;

use Swoole\Http\Request;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

interface WsEventsHandler extends EventsHandler
{
    public function onOpen(Server $server, Request $request): void;

    public function onMessage(Server $ws, Frame $frame): bool;

    public function onClose(Server $ws, int $fd): void;
}
