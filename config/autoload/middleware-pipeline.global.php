<?php

return [
    'middleware_pipeline' => [
        'pre_routing' => [
            [ 'middleware' => App\Middleware\CacheMiddleware::class ],
        ],
        'post_routing' => [
        ],
    ],
];
