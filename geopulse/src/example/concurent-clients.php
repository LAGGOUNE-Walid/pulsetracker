<?php

use Swoole\Coroutine;
use Swoole\Coroutine\Client;

use function Swoole\Coroutine\run;

$numberOfClients = 1;

$sendInterval = 1000;

// $data = ['appId' => '123', 'clientId' => '22f8e456-93f2-4173-8f2d-8a010abcceb1', 'data' => ['type' => 'Point', 'coordinates' => [1, 1]]];
$data = [
    'appId' => 'cc0248b2-4e87-4714-9754-6ed23436459d',
    'clientId' => '8a4bab21-7f3d-42cd-88cc-09d365bd6cf9',
    'data' => ['type' => 'Point', 'coordinates' => [-14.80665, -140.22159]],
];
$jsonData = json_encode($data);

function simulateClient($host, $port, $jsonData, $sendInterval)
{
    $client = new Client(SWOOLE_SOCK_UDP);

    if (! $client->connect($host, $port, 0.5)) {
        echo "Connect failed. Error: {$client->errCode}\n";

        return;
    }
    while (true) {
        $client->send($jsonData);
        Coroutine::sleep($sendInterval / 1000);
    }

    $client->close();
}

run(function () use ($numberOfClients, $jsonData, $sendInterval) {
    $host = 'udp-tracking.pulsestracker.com';
    $port = 9506;
    for ($i = 0; $i < $numberOfClients; $i++) {
        go(function () use ($host, $port, $jsonData, $sendInterval) {
            simulateClient($host, $port, $jsonData, $sendInterval);
        });
    }

    echo "Load test with {$numberOfClients} clients sending messages every {$sendInterval}ms started.\n";
});
