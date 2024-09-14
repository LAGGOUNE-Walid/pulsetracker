<?php

return [
    'plans' => [
        "free" => [
            'name' => 'free',
            'price' => 0,
            'price_id' => null,
            'size' => [
                'apps' => 1,
                'devices' => 3,
                'messages_per_day' => 1_500,
                'data_retention_days' => 7,
                'wesockets_limits' => 1
            ]
        ],
        "pro" => [
            'name' => 'pro',
            'price' => 49,
            'price_id' => 'pri_01j7p1hvxz3ptxw9ebrrxkdzh7',
            'size' => [
                'apps' => 5,
                'devices' => 25,
                'messages_per_day' => 100_000,
                'data_retention_days' => 30,
                'wesockets_limits' => null
            ]
        ],
        "enterprise" => [
            'name' => 'enterprise',
            'price_id' => 'pri_01j7p1k24mh7sp2dpbprazpz1q',
            'price' => 199,
            'size' => [
                'apps' => null,
                'devices' => 100,
                'messages_per_day' => 1_000_000,
                'data_retention_days' => 90,
                'wesockets_limits' => null
            ]
        ]
    ],
];
