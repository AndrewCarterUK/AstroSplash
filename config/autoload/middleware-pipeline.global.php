<?php

return [
    'dependencies' => [
        'factories' => [
            App\Middleware\CacheMiddleware::class => App\Middleware\CacheFactory::class,
        ]
    ],
    'middleware_pipeline' => [
        'pre_routing' => [
            [ 'middleware' => App\Middleware\CacheMiddleware::class ],
        ],
        'post_routing' => [
        ],
    ],
];
