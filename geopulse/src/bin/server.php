<?php

use Swoole\Server;
use Swoole\Coroutine;
use Swoole\Process\Pool;
use Swoole\Process\Manager;

use League\Container\Container;
use function Swoole\Coroutine\run;
use Illuminate\Queue\Capsule\Manager as Queue;
use Pulse\Server\EventHandler\SwooleUdpServerEventHandler;

require 'bin/bootstrap.php';

function startQueueWorker($table, Container $container)
{
    $queue = $container->get(Queue::class);
    while (true) {
        $job = $queue->pop('geopulse-users-apps');
        if ($job) {
            $jobClassName = $job->payload()['displayName'];
            $jobClass = new $jobClassName($table, ...$job->payload()['data']);
            $jobClass->handle();
            $job->delete();
        }
        usleep(500000);
    }
}

function startServer($table, array $config, SwooleUdpServerEventHandler $swooleUdpEventsHandler)
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

$pm = new Manager();
$pm->add(function (Pool $pool, int $workerId) use ($appsDevicesTable, $config, $swooleUdpEventsHandler) {
    startServer($appsDevicesTable, $config, $swooleUdpEventsHandler);
});
$pm->add(function (Pool $pool, int $workerId) use ($appsDevicesTable, $container) {
    startQueueWorker($appsDevicesTable, $container);
});

$pm->start();
