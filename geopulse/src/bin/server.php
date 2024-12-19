<?php

use Illuminate\Queue\Capsule\Manager as Queue;
use League\Container\Container;
use Pulse\Server\Custom\Gps103Server;
use Pulse\Server\Custom\RedisServer;
use Pulse\Server\Custom\UdpServer;
use Pulse\Server\Custom\WsServer;
use Pulse\Server\EventHandler\SwooleGps103TcpServerEventHandler;
use Pulse\Server\EventHandler\SwooleRedisServerEventHandler;
use Pulse\Server\EventHandler\SwooleUdpServerEventHandler;
use Pulse\Server\EventHandler\SwooleWsServerEventHandler;
use Swoole\Process\Manager;
use Swoole\Process\Pool;

require 'bin/bootstrap.php';

$pm = new Manager;
$pm->add(function (Pool $pool, int $workerId) use ($config, $container) {
    $udpServer = $container->get(UdpServer::class)->setAddress('0.0.0.0')->setPort(9505)->create();
    $udpServer->setEventsHandler($container->get(SwooleUdpServerEventHandler::class));
    $udpServer->setConfig($config['swoole']);
    $udpServer->start();
});

$pm->add(function (Pool $pool, int $workerId) use ($config, $container) {
    $wsServer = $container->get(WsServer::class)->setAddress('0.0.0.0')->setPort(9509)->create();
    $wsServer->setEventsHandler($container->get(SwooleWsServerEventHandler::class));
    $wsServer->setConfig($config['swoole']);
    $wsServer->start();
});

$pm->add(function (Pool $pool, int $workerId) use ($container) {
    $swooleRedisServerEventsHandler = $container->get(SwooleRedisServerEventHandler::class);
    $redisServer = $container->get(RedisServer::class)->setAddress('0.0.0.0')->setPort(6378)->create();
    $redisServer->setEventsHandler($swooleRedisServerEventsHandler);
    $redisServer->getServer()->addProcess($swooleRedisServerEventsHandler->getListenerProcess());
    $redisServer->start();
});

$pm->add(function (Pool $pool, int $workerId) use ($config, $container) {
    $gps103server = $container->get(Gps103Server::class)->setAddress('0.0.0.0')->setPort(5001)->create();
    $gps103server->setEventsHandler($container->get(SwooleGps103TcpServerEventHandler::class));
    $gps103server->setConfig($config['gps103']);
    $gps103server->start();
});

$pm->add(function () use ($httpClient) {
    try {
        $httpClient->request('GET', 'https://uptime.betterstack.com/api/v1/heartbeat/fEzyiyJf3hSET2RkiKv8CrWT');
    } catch (\Throwable $th) {
        \Sentry\captureException($th);
    }
    sleep(1 * 60);
});

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
$pm->add(function (Pool $pool, int $workerId) use ($appsDevicesTable, $container, $usersQuotaTable) {
    startQueueWorker($appsDevicesTable, $usersQuotaTable, $container);
});

$pm->start();
