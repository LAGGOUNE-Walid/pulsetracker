<?php

use Swoole\Coroutine\Client;

use function Swoole\Coroutine\run;

run(function () {
    $client = new Client(SWOOLE_SOCK_UDP);
    if (! $client->connect('192.168.1.7', 9505, 0.5)) {
        echo "connect failed. Error: {$client->errCode}\n";
    }
    $data = [
        'appId' => 'f1834d82-c3ee-4e3b-8891-ac04fc756684',
        'clientId' => '8ec2f812-7888-4567-a8f6-232c71772015',
        // long,lat
        'data' => ['type' => 'Point', 'coordinates' => [-0.136302, 51.498132]],
    ];
    // $data = msgpack_pack($data);
    $data = json_encode($data);

    $long = [-0.136302,  -0.125394, -0.117063,  -0.139050];
    $lat = [51.510206, 51.498132, 51.502834, 51.497330];
    $locations = [
        [-0.070745, 51.509472],
        [-0.070906, 51.509816],
        [-0.071368, 51.510700],
    ];
    $clients = ['8ec2f812-7888-4567-a8f6-232c71772015', '38012075-23b8-4b6e-9889-532463abf1a1', '08f3f5b5-cb26-45cc-8225-e954117fdd68', '0db9c544-d7c4-43f9-beea-b3de89898ef8'];
    $data = [
        'appId' => '734d7296-5608-48dc-bc34-81e7c1de1fea',
        // 'clientId' => $clients[array_rand($clients)],
        'clientId' => '2096c776-4b20-456b-a064-330be871ffdd',
        // long,lat
        'data' => ['type' => 'Point', 'coordinates' => $locations[array_rand($locations)]],
        'extra' => [
            'speed' => 100,
        ],
    ];
    $data = json_encode($data);
    while (true) {

        $client->send($data);
        usleep(10000);
        exit;
    }

    $client->close();
});
