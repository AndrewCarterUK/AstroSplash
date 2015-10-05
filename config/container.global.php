<?php

return [
    'factories' => [
        'AndrewCarterUK\\APOD\\APIInterface'                    => 'Application\\Container\\APIFactory',
        'Application\\Middleware\\Pipe\\CacheMiddleware'        => 'Application\\Container\\Middleware\\Pipe\\CacheMiddlewareFactory',
        'Application\\Middleware\\Route\\IndexMiddleware'       => 'Application\\Container\\Middleware\\Route\\IndexMiddlewareFactory',
        'Application\\Middleware\\Route\\PictureListMiddleware' => 'Application\\Container\\Middleware\\Route\\PictureListMiddlewareFactory',
        'Doctrine\\Common\\Cache\\Cache'                        => 'Application\\Container\\CacheFactory',
        'Zend\\Expressive\\Application'                         => 'Zend\\Expressive\\Container\\ApplicationFactory',
        'Zend\\Expressive\\Template\\TemplateInterface'         => 'Zend\\Expressive\\Container\\Template\\PlatesFactory',
        'Zend\\Expressive\\FinalHandler'                        => 'Zend\\Expressive\\Container\\TemplatedErrorHandlerFactory',
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
                    [ 'middleware' => 'Application\\Middleware\\Pipe\\CacheMiddleware' ],
                ],
            ],
            'application' => [
                'results_per_page' => 24,
                'cache_path'       => 'cache/',
                'apod_api'         => [
                    'api_key'    => 'DEMO-KEY',
                    'store_path' => 'public/apod',
                    'base_url'   => '/apod',
                ],
            ],
        ],
    ],
];
