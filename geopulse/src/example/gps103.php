<?php

use Swoole\Coroutine\Client;

use function Swoole\Coroutine\run;

run(function () {
    $client = new Client(SWOOLE_SOCK_TCP);
    if (! $client->connect('127.0.0.1', 5001, 0.5)) {
        echo "connect failed. Error: {$client->errCode}\n";
        exit;
    }
    // $client->send("123123;");
    $client->send('##,imei:123123,A;');
    while (true) {
        var_dump($client->send('imei:123123,tracker,0809231929,13554900601,F,112909.397,A,2234.4669,N,11354.3287,E,0.11,;'));
        echo "Sent \n";
        sleep(3);
    }

    // $client->close();
});
