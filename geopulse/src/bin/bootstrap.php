<?php

use Illuminate\Container\Container as LaravelContainer;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Queue\Capsule\Manager as Queue;
use Illuminate\Redis\RedisManager;
use jacklul\MonologTelegramHandler\TelegramFormatter;
use jacklul\MonologTelegramHandler\TelegramHandler;
use League\Container\Container;
use Monolog\Level;
use Monolog\Logger;
use Pulse\Actions\BroadcastPacketAction;
use Pulse\Actions\EnqueuePacketAction;
use Pulse\Pool\QueueConnectionPool;
use Pulse\Server\Custom\Gps103Server;
use Pulse\Server\Custom\RedisServer;
use Pulse\Server\Custom\UdpServer;
use Pulse\Server\Custom\WsServer;
use Pulse\Server\EventHandler\SwooleGps103TcpServerEventHandler;
use Pulse\Server\EventHandler\SwooleRedisServerEventHandler;
use Pulse\Server\EventHandler\SwooleUdpServerEventHandler;
use Pulse\Server\EventHandler\SwooleWsServerEventHandler;
use Pulse\Server\PacketParser\Gps103PacketParser;
use Pulse\Server\PacketParser\UdpPacketParser;
use Pulse\Server\PacketParser\WsPacketParser;
use Pulse\Services\BroadcastPacketService;
use Pusher\Pusher;

require 'vendor/autoload.php';
$config = require 'config/pulse.php';

$container = new Container;
$laravelContainer = new LaravelContainer;

$container->add(Logger::class, function () use ($config) {
    $logger = new Logger('Geopulse-server');
    $handler = new TelegramHandler(
        $config['telegram']['TELEGRAM_BOT_TOKEN'],
        $config['telegram']['TELEGRAM_CHANNEL_ID'],
        Level::Debug,
        true,
        true,
        10,
        true
    );
    $handler->setFormatter(new TelegramFormatter);
    $logger->pushHandler($handler);

    return $logger;
});

if ($config['enable-queue']) {
    $container->add(Queue::class, function () use ($config, $laravelContainer) {
        $queue = new Queue($laravelContainer);
        $redisConfig = $config['redis'];
        $redisManager = new RedisManager($laravelContainer, $redisConfig['client'], $redisConfig);
        $laravelContainer->instance('redis', $redisManager);
        $queue->getContainer()->singleton('redis', function () use ($redisManager) {
            return $redisManager;
        });
        $queue->addConnection($config['queue-connection']);
        $queue->setAsGlobal();

        return $queue;
    });
}

$app_id = $config['broadcasting']['connections']['pusher']['app_id'];
$app_key = $config['broadcasting']['connections']['pusher']['key'];
$app_secret = $config['broadcasting']['connections']['pusher']['secret'];
$options = $config['broadcasting']['connections']['pusher']['options'];
$httpClient = new \GuzzleHttp\Client(['verify' => false]);
$pusher = new Pusher($app_key, $app_secret, $app_id, $options, $httpClient);

if ($config['enable-database']) {
    $container->add(DB::class, function () use ($config) {
        $db = new DB;

        $db->addConnection($config['database-connection']);
        $db->setAsGlobal();
        $db->bootEloquent();

        return $db;
    });
}

$container->add(BroadcastPacketService::class, function () use ($config, $container, $pusher) {
    $broadcaster = new BroadcastPacketService;
    if ($config['enable-queue']) {
        $queueConnectionsPool = new QueueConnectionPool($container, $config['queue-pool-size']);
        $broadcaster->addAction(new EnqueuePacketAction($queueConnectionsPool));
    }
    $broadcaster->addAction(new BroadcastPacketAction($pusher));

    return $broadcaster;
});

$db = $container->get(DB::class);
$apps = $db->table('apps')->get();

$largestDevicesSizesInBytes = 1024;
foreach ($apps as $app) {
    $devices = $db->table('devices')->where('app_id', $app->id)->get();
    if ($devices->count() > 0) {
        $appDevicesSizeInBytes = strlen($devices->pluck('key')->toJson());
        if ($appDevicesSizeInBytes > $largestDevicesSizesInBytes) {
            $largestDevicesSizesInBytes = $appDevicesSizeInBytes;
        }
    }
}

$appsDevicesTable = new Swoole\Table(1024);
$appsDevicesTable->column('devicesKeys', Swoole\Table::TYPE_STRING, $largestDevicesSizesInBytes + 1024);
$appsDevicesTable->column('userId', Swoole\Table::TYPE_INT);
$appsDevicesTable->create();

$devices = $db->table('devices')->get();
$deviceAppsTable = new Swoole\Table($devices->count() + 1024);
$deviceAppsTable->column('appKey', Swoole\Table::TYPE_STRING, 36);
$deviceAppsTable->column('userId', Swoole\Table::TYPE_INT);
$deviceAppsTable->create();

foreach ($devices as $device) {
    $deviceAppsTable->set($device->key, ['appKey' => $device->app_key, 'userId' => $device->user_id]);
}

$usersQuotaTable = new Swoole\Table($db->table('users')->whereNotNull('email_verified_at')->count() * 2);
$usersQuotaTable->column('quota', Swoole\Table::TYPE_INT);
$usersQuotaTable->column('used', Swoole\Table::TYPE_INT);
$usersQuotaTable->column('left', Swoole\Table::TYPE_INT);
$usersQuotaTable->create();

$usersIds = [];
foreach ($apps as $app) {
    $devices = $db->table('devices')->where('app_id', $app->id)->get();
    if ($devices->count() > 0) {
        $appsDevicesTable->set($app->key, ['devicesKeys' => $devices->pluck('key')->toJson(), 'userId' => $app->user_id]);
    }
    if (array_search($app->user_id, $usersIds) === false) {
        $usersIds[] = $app->user_id;
    }
}
if ($usersIds !== []) {

    $response = $httpClient->request('GET', $config['api_server'].'/api/users/quota?'.http_build_query(['ids' => $usersIds]));
    if ($response->getStatusCode() == 200) {
        $usersQuotaResponse = json_decode($response->getBody(), true);
        if ($usersQuotaResponse) {
            foreach ($usersQuotaResponse['data'] as $userQuota) {
                $usersQuotaTable->set($userQuota['id'], [
                    'quota' => $userQuota['quota'],
                    'used' => $userQuota['used'],
                    'left' => $userQuota['left'],
                ]);
            }
        }
    } else {
        throw new Exception('Error Processing Request to get users quota', 1);
    }
    unset($response);
}

$appsSubscribersTable = new Swoole\Table(count($apps) + 1024);
$appsSubscribersTable->column('subscribers', Swoole\Table::TYPE_STRING, 1000);
$appsSubscribersTable->create();

$subscribersAppTable = new Swoole\Table(1024);
$subscribersAppTable->column('channel', Swoole\Table::TYPE_STRING, 64);
$subscribersAppTable->create();

unset($usersIds);
unset($apps);

$container->add(UdpPacketParser::class)->addArgument($config['use-msgPack']);
$container->add(WsPacketParser::class)->addArgument($config['use-msgPack']);
$container->add(Gps103PacketParser::class);

$logger = $container->get(Logger::class);

$container->add(SwooleUdpServerEventHandler::class)
    ->addArgument(UdpPacketParser::class)
    ->addArgument(BroadcastPacketService::class)
    ->addArgument($appsDevicesTable)
    ->addArgument($usersQuotaTable)
    ->addArgument($logger);

$container->add(SwooleWsServerEventHandler::class)
    ->addArgument(WsPacketParser::class)
    ->addArgument(BroadcastPacketService::class)
    ->addArgument($appsDevicesTable)
    ->addArgument($usersQuotaTable)
    ->addArgument($logger);

$container->add(SwooleRedisServerEventHandler::class)
    ->addArgument($appsDevicesTable)
    ->addArgument($appsSubscribersTable)
    ->addArgument($subscribersAppTable)
    ->addArgument($db)
    ->addArgument($container->get(Queue::class));

$container->add(SwooleGps103TcpServerEventHandler::class)
    ->addArgument(Gps103PacketParser::class)
    ->addArgument(BroadcastPacketService::class)
    ->addArgument($deviceAppsTable)
    ->addArgument($usersQuotaTable)
    ->addArgument($logger);

\Sentry\init([
    'dsn' => 'https://edf86eb6486765d336450b383fdd60b0@o4508063795904512.ingest.de.sentry.io/4508063843876944',
    // Specify a fixed sample rate
    'traces_sample_rate' => 1.0,
    // Set a sampling rate for profiling - this is relative to traces_sample_rate
    'profiles_sample_rate' => 1.0,
]);

// $swooleUdpEventsHandler = $container->get(SwooleUdpServerEventHandler::class);
// $swooleWsEventsHandler = $container->get(SwooleWsServerEventHandler::class);
// $swooleRedisServerEventsHandler = $container->get(SwooleRedisServerEventHandler::class);
// $swooleGps103TcpServerEventHandler = $container->get(SwooleGps103TcpServerEventHandler::class);

$container->add(UdpServer::class);
$container->add(WsServer::class);
$container->add(RedisServer::class);
$container->add(Gps103Server::class);

// $logger->debug('Servers starting');
