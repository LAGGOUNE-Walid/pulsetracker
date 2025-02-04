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
        // 'appId' => '78981cd5-a6d9-4fa4-8ba9-4108791e9fa7',
        'clientId' => 'ac01cdfd-9891-4773-b988-04c0180eeece',
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
