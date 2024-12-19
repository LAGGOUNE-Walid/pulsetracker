<?php

namespace Pulse\Contracts\Server;

use Swoole\Process;
use Swoole\Redis\Server as SwooleRedisServer;
use Swoole\Server;

interface RedisEventsHandler extends EventsHandler
{
    public function setServer(SwooleRedisServer $server): void;

    public function emptyResponse(int $fd, $data): void;

    public function subscribe(int $fd, array $data): bool;

    public function attachSubscriberToChannel(int $fd, string $channel): void;

    public function attachChannelToSubscriber(int $fd, string $channel): void;

    public function unsubscribe(Server $server, int $fd): void;

    public function getListenerProcess(): Process;

    public function ping(int $fd, array $data): void;
}
