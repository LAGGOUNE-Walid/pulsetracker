<?php

return [
    
    'plans' => [
        'free' => [
            'name' => 'free',
            'price' => 0,
            'product_id' => null,
            'price_id' => null,
            'size' => [
                'apps' => 1,
                'devices' => 3,
                'messages_per_month' => 2500,
                'data_retention_days' => 7,
                'wesockets_limits' => null,
            ],
        ],
        'pro' => [
            'name' => 'pro',
            'price' => 49,
            'product_id' => 'prod_R6hEi2EsZ1HlSa',
            'price_id' => 'price_1QETpyBi3kjHIWhO7jVOfMp3',
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
            'product_id' => 'prod_R6hEi2EsZ1HlSa',
            'price_id' => 'price_1QEYaMBi3kjHIWhOyvjdM0G3',
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
