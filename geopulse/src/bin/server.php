<?php

use Illuminate\Queue\Capsule\Manager as Queue;
use League\Container\Container;
use Pulse\Server\EventHandler\SwooleUdpServerEventHandler;
use Pulse\Server\EventHandler\SwooleWsServerEventHandler;
use Swoole\Process\Manager;
use Swoole\Process\Pool;
use Swoole\Server;

require 'bin/bootstrap.php';

function startQueueWorker($appsDevicesTable, $usersQuotaTable, Container $container)
{
    $queue = $container->get(Queue::class);
    while (true) {
        $job = $queue->pop('geopulse-users-apps');
        if ($job) {
            $jobClassName = $job->payload()['displayName'];
            try {
                $jobClass = new $jobClassName($appsDevicesTable, $usersQuotaTable, ...$job->payload()['data']);
                $jobClass->handle();
            } catch (\Throwable $th) {
                \Sentry\captureException($th);
            }

            $job->delete();
        }
        usleep(500000);
    }
}

function startUdpServer(array $config, SwooleUdpServerEventHandler $swooleUdpEventsHandler)
{
    $server = new Server(
        '0.0.0.0',
        $config['port'],
        SWOOLE_PROCESS,
        SWOOLE_SOCK_UDP
    );
    $server->set($config['swoole']);
    $server->on('Packet', [$swooleUdpEventsHandler, 'onPacket']);
    $server->start();
}

function startWsServer(array $config, SwooleWsServerEventHandler $swooleWsServerEventHandler)
{
    $ws = new Swoole\WebSocket\Server('0.0.0.0', $config['ws_port']);
    $ws->set($config['swoole']);
    $ws->on('Open', [$swooleWsServerEventHandler, 'onOpen']);
    $ws->on('Message', [$swooleWsServerEventHandler, 'onMessage']);
    $ws->on('Close', [$swooleWsServerEventHandler, 'onClose']);
    $ws->start();
}

$pm = new Manager;
$pm->add(function (Pool $pool, int $workerId) use ($config, $swooleUdpEventsHandler) {
    startUdpServer($config, $swooleUdpEventsHandler);
});
$pm->add(function (Pool $pool, int $workerId) use ($appsDevicesTable, $container, $usersQuotaTable) {
    startQueueWorker($appsDevicesTable, $usersQuotaTable, $container);
});

$pm->add(function (Pool $pool, int $workerId) use ($config, $swooleWsEventsHandler) {
    startWsServer($config, $swooleWsEventsHandler);
});

$pm->add(function() use ($httpClient) {
    $httpClient->request('GET', 'https://uptime.betterstack.com/api/v1/heartbeat/fEzyiyJf3hSET2RkiKv8CrWT');
    sleep(1*60);
});

$pm->start();
