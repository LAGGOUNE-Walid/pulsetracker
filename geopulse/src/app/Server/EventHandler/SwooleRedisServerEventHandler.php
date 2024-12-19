<?php

namespace Pulse\Server\EventHandler;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Queue\Capsule\Manager as Queue;
use Pulse\Contracts\Server\RedisEventsHandler;
use Pulse\Traits\SwooleRedisServerSubscriberAuth;
use Swoole\Process;
use Swoole\Redis\Server as SwooleRedisServer;
use Swoole\Server;
use Swoole\Table;

class SwooleRedisServerEventHandler implements RedisEventsHandler
{
    use SwooleRedisServerSubscriberAuth;

    private array $subscribers = [];

    protected array $connectionsToChannels = [];

    private SwooleRedisServer $server;

    public function __construct(
        private Table $appsDevicesTable,
        private Table $appsSubscribersTable,
        private Table $subscribersAppTable,
        private DB $db,
        private Queue $queue
    ) {}

    public function setServer(SwooleRedisServer $server): void
    {
        $this->server = $server;
    }

    public function emptyResponse(int $fd, $data): void
    {
        $this->server->send($fd, SwooleRedisServer::format(SwooleRedisServer::INT, 1));
    }

    public function subscribe(int $fd, array $data): bool
    {
        $channel = $this->check($data);
        if ($channel === null) {
            return $this->server->close($fd);
        }

        $this->attachSubscriberToChannel($fd, $channel);
        $this->attachChannelToSubscriber($fd, $channel);

        return $this->server->send($fd, SwooleRedisServer::format(SwooleRedisServer::SET, ['subscribe', $channel, 1]));
    }

    public function attachSubscriberToChannel(int $fd, string $channel): void
    {
        if (! $this->appsSubscribersTable->exist($channel)) {
            $appSubscribers = [$fd];
        } else {
            $appSubscribers = $this->appsSubscribersTable->get($channel)['subscribers'];
            $appSubscribers = json_decode($appSubscribers, true);
            $appSubscribers[] = $fd;
        }
        $this->appsSubscribersTable->set($channel, ['subscribers' => json_encode($appSubscribers)]);
    }

    public function attachChannelToSubscriber(int $fd, string $channel): void
    {
        $this->subscribersAppTable->set($fd, ['channel' => $channel]);
    }

    public function unsubscribe(Server $server, int $fd): void
    {

        if ($this->subscribersAppTable->exists($fd)) {
            $channel = $this->subscribersAppTable->get($fd)['channel'];
            if ($this->appsSubscribersTable->exists($channel)) {
                $subscribers = json_decode($this->appsSubscribersTable->get($channel)['subscribers'], true);
                $subscriberKeyInChannel = array_search($fd, $subscribers);
                if ($subscriberKeyInChannel !== false) {
                    unset($subscribers[$subscriberKeyInChannel]);
                    $this->appsSubscribersTable->set($channel, ['subscribers' => json_encode($subscribers)]);
                }
            }
            $this->subscribersAppTable->del($fd);
        }
    }

    public function getListenerProcess(): Process
    {
        return new Process(function ($process) {

            while (true) {
                $job = $this->queue->pop('geopulse-redis-pubsub');
                if ($job) {
                    $payload = $job->payload()['data'];
                    if ($this->appsSubscribersTable->exists($payload['appId'])) {
                        $subscribers = json_decode($this->appsSubscribersTable->get($payload['appId'])['subscribers'], true);
                        foreach ($subscribers as $fd) {
                            $this->server->send($fd, SwooleRedisServer::format(SwooleRedisServer::SET, ['message', $payload['appId'], json_encode($payload)]));
                        }
                    }
                    $job->delete();
                }
                foreach ($this->subscribersAppTable as $subscriber => $channel) {
                    $this->server->send($subscriber, SwooleRedisServer::format(SwooleRedisServer::SET, ['pong', '', '']));
                }

                usleep(500000);
            }
        });
    }

    public function ping(int $fd, array $data): void
    {
        $this->server->send($fd, SwooleRedisServer::format(SwooleRedisServer::STRING, 'pong'));
    }
}
