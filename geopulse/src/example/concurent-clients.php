<?php

use Swoole\Coroutine;
use Swoole\Coroutine\Client;

use function Swoole\Coroutine\run;

$numberOfClients = 4;

$sendInterval = 100;

$data = ['appId' => '123', 'clientId' => '22f8e456-93f2-4173-8f2d-8a010abcceb1', 'data' => ['type' => 'Point', 'coordinates' => [1, 1]]];
$data = [
    'appId' => '272a0151-6251-432a-889f-d8d8d6ae7314',
    'clientId' => '2ac172ac-3234-4820-98a0-8dc62ba30e19',
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
    $host = '192.168.1.7';
    $port = 9505;
    for ($i = 0; $i < $numberOfClients; $i++) {
        go(function () use ($host, $port, $jsonData, $sendInterval) {
            simulateClient($host, $port, $jsonData, $sendInterval);
        });
    }

    echo "Load test with {$numberOfClients} clients sending messages every {$sendInterval}ms started.\n";
});
