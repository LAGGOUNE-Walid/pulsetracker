<?php

use Monolog\Level;
use Pusher\Pusher;
use Monolog\Logger;
use League\Container\Container;
use Illuminate\Redis\RedisManager;
use Pulse\Pool\QueueConnectionPool;
use Pulse\Actions\EnqueuePacketAction;
use Pulse\Actions\BroadcastPacketAction;
use Pulse\Services\BroadcastPacketService;
use Pulse\Server\PacketParser\WsPacketParser;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Queue\Capsule\Manager as Queue;
use Pulse\Server\PacketParser\UdpPacketParser;
use jacklul\MonologTelegramHandler\TelegramHandler;
use jacklul\MonologTelegramHandler\TelegramFormatter;
use Illuminate\Container\Container as LaravelContainer;
use Pulse\Server\EventHandler\SwooleWsServerEventHandler;
use Pulse\Server\EventHandler\SwooleUdpServerEventHandler;

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
    $handler->setFormatter(new TelegramFormatter()); 
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
$appsDevicesTable->column('devicesKeys', Swoole\Table::TYPE_STRING, $largestDevicesSizesInBytes+1024);
$appsDevicesTable->column('userId', Swoole\Table::TYPE_INT);
$appsDevicesTable->create();

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

    $response = $httpClient->request('GET', $config['api_server'] . '/api/users/quota?' . http_build_query(['ids' => $usersIds]));
    if ($response->getStatusCode() == 200) {
        $usersQuotaResponse = json_decode($response->getBody(), true)['data'];
        foreach ($usersQuotaResponse as $userQuota) {
            //echo 'Set user ' . $userQuota['id'] . " quota to cache \n";
            //print_r($userQuota);
            //echo "\n";
            $usersQuotaTable->set($userQuota['id'], [
                'quota' => $userQuota['quota'],
                'used' => $userQuota['used'],
                'left' => $userQuota['left'],
            ]);
        }
    } else {
        throw new Exception('Error Processing Request to get users quota', 1);
    }
    unset($response);
}

unset($usersIds);
$container->add(UdpPacketParser::class)->addArgument($config['use-msgPack']);
$container->add(WsPacketParser::class)->addArgument($config['use-msgPack']);

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

\Sentry\init([
    'dsn' => 'https://edf86eb6486765d336450b383fdd60b0@o4508063795904512.ingest.de.sentry.io/4508063843876944',
    // Specify a fixed sample rate
    'traces_sample_rate' => 1.0,
    // Set a sampling rate for profiling - this is relative to traces_sample_rate
    'profiles_sample_rate' => 1.0,
]);

$logger->debug("Servers starting");
$swooleUdpEventsHandler = $container->get(SwooleUdpServerEventHandler::class);
$swooleWsEventsHandler = $container->get(SwooleWsServerEventHandler::class);
