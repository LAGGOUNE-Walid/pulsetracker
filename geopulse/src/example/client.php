<?php

use Swoole\Coroutine\Client;

use function Swoole\Coroutine\run;

run(function () {
    $client = new Client(SWOOLE_SOCK_UDP);
    if (! $client->connect('127.0.0.1', 9505, 0.5)) {
        echo "connect failed. Error: {$client->errCode}\n";
    }

    $locations = [
        [-0.070745, 51.509472],
        [-0.070906, 51.509816],
        [-0.071368, 51.510700],
    ];

    $data = [
        'appId' => 'a9b8dffd-e68c-4bff-95cd-21fbcb86fcfb',
        'clientId' => '3faffcfa-d486-4e38-9598-e27ff129b6e9',
        // long,lat
        'data' => ['type' => 'Point', 'coordinates' => $locations[array_rand($locations)]],
        'extra' => [
            'speed' => 100,
        ],
    ];
    $data = json_encode($data);
    while (true) {

        $client->send($data);
        echo "Sent \n";
        sleep(1);
    }

    $client->close();
});
