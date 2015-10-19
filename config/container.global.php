<?php

return [
    'factories' => [
        'Application\\Action\\IndexAction'                        => 'Application\\Container\\Action\\IndexActionFactory',
        'Zend\\Expressive\\Application'                           => 'Zend\\Expressive\\Container\\ApplicationFactory',
        'Zend\\Expressive\\Template\\TemplateRendererInterface'   => 'Zend\\Expressive\\Plates\\PlatesRendererFactory',
        'Zend\\Expressive\\FinalHandler'                          => 'Zend\\Expressive\\Container\\TemplatedErrorHandlerFactory',
        'Application\\Middleware\\CacheMiddleware'                => 'Application\\Container\\Middleware\\CacheMiddlewareFactory',
        'Doctrine\\Common\\Cache\\Cache'                          => 'Application\\Container\\CacheFactory',
        'AndrewCarterUK\\APOD\\APIInterface'                      => 'Application\\Container\\APIFactory',
        'Application\\Action\\PictureListAction'                  => 'Application\\Container\\Action\\PictureListActionFactory',
    ],
    'invokables' => [
        'Zend\\Expressive\\Router\\RouterInterface' => 'Zend\\Expressive\\Router\\AuraRouter',
    ],
    'services' => [
        'config' => [
            'routes' => [
                [
                    'path'            => '/',
                    'middleware'      => 'Application\\Action\\IndexAction',
                    'allowed_methods' => ['GET'],
                ],
                [
                    'path'            => '/picture-list',
                    'middleware'      => 'Application\\Action\\PictureListAction',
                    'allowed_methods' => ['GET'],
                ],
                [
                    'path'            => '/picture-list/{page}',
                    'middleware'      => 'Application\\Action\\PictureListAction',
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
                    'template_404'   => 'error::404',
                    'template_error' => 'error::internal',
                ],
            ],
            'middleware_pipeline' => [
                'pre_routing' => [
                    [ 'middleware' => 'Application\\Middleware\\CacheMiddleware' ],
                ],
            ],
            'application' => [
                'cache_path'       => 'cache/',
                'results_per_page' => 24,
                'apod_api'         => [
                    'store_path' => 'public/apod',
                    'base_url'   => '/apod',
                ],
            ],
        ],
    ],
];

