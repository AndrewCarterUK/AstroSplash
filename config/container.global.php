<?php

return [
    'factories' => [
        'Application\\Middleware\\Route\\IndexMiddleware'    => 'Application\\Container\\Middleware\\Route\\IndexMiddlewareFactory',
        'Application\\Middleware\\Pipe\\CacheMiddleware'     => 'Application\\Container\\Middleware\\Pipe\\CacheMiddlewareFactory',
        'Application\\Middleware\\Pipe\\RateLimitMiddleware' => 'Application\\Container\\Middleware\\Pipe\\RateLimitMiddlewareFactory',
        'Doctrine\\Common\\Cache\\Cache'                     => 'Application\\Container\\CacheFactory',
        'Zend\\Expressive\\Application'                      => 'Zend\\Expressive\\Container\\ApplicationFactory',
        'Zend\\Expressive\\Template\\TemplateInterface'      => 'Zend\\Expressive\\Container\\Template\\PlatesFactory',
        'Zend\\Expressive\\FinalHandler'                     => 'Zend\\Expressive\\Container\\TemplatedErrorHandlerFactory',
    ],
    'invokables' => [
        'Zend\\Expressive\\Router\\RouterInterface' => 'Zend\\Expressive\\Router\\AuraRouter',
    ],
    'services' => [
        'config' => [
            'routes' => [
                [
                    'path'            => '/',
                    'middleware'      => 'Application\\Middleware\\Route\\IndexMiddleware',
                    'allowed_methods' => ['GET'],
                ],
                [
                    'path'            => '/picture-list',
                    'middleware'      => 'Application\\Middleware\\Route\\PictureListMiddleware',
                    'allowed_methods' => ['GET'],
                ],
                [
                    'path'            => '/picture-list/{page}',
                    'middleware'      => 'Application\\Middleware\\Route\\PictureListMiddleware',
                    'allowed_methods' => ['GET'],
                    'options'         => [
                        'tokens' => ['page' => '\d+']
                    ],
                ],
            ],
            'templates' => [
                'extension' => 'plates.php',
                'paths'     => [
                    'app'   => 'templates/app',
                    'error' => 'templates/error',
                ],
            ],
            'zend-expressive' => [
                'error_handler' => [
                    'template_404'   => 'error::404-error',
                    'template_error' => 'error::error',
                ],
            ],
            'middleware_pipeline' => [
                'pre_routing' => [
                    [ 'middleware' => 'Application\\Middleware\\Pipe\\RateLimitMiddleware' ],
                    [ 'middleware' => 'Application\\Middleware\\Pipe\\CacheMiddleware'     ],
                ],
            ],
            'cache_path'   => 'cache/',
            'nasa_api_key' => 'DEMO-KEY',
            'hourly_limit' => 1000,
        ],
    ],
];
