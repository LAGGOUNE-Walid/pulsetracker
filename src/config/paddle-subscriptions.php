<?php

return [
    'plans' => [
        'free' => [
            'name' => 'free',
            'price' => 0,
            'price_id' => null,
            'size' => [
                'apps' => 1,
                'devices' => 3,
                'messages_per_month' => 2500,
                'data_retention_days' => 7,
                'wesockets_limits' => 1,
            ],
        ],
        'pro' => [
            'name' => 'pro',
            'price' => 49,
            'price_id' => 'pri_01j7p1hvxz3ptxw9ebrrxkdzh7',
            'size' => [
                'apps' => 5,
                'devices' => 25,
                'messages_per_month' => 50000,
                'data_retention_days' => 30,
                'wesockets_limits' => null,
            ],
        ],
        'enterprise' => [
            'name' => 'enterprise',
            'price_id' => 'pri_01j7p1k24mh7sp2dpbprazpz1q',
            'price' => 149,
            'size' => [
                'apps' => null,
                'devices' => 500,
                'messages_per_month' => 5000000,
                'data_retention_days' => 90,
                'wesockets_limits' => null,
            ],
        ],
    ],
];
