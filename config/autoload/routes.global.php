<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'index',
            'path' => '/',
            'middleware' => App\Action\IndexAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'path' => '/picture-list',
            'middleware' => App\Action\PictureListAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'path' => '/picture-list/{page}',
            'middleware' => App\Action\PictureListAction::class,
            'allowed_methods' => ['GET'],
            'options' => [
                'tokens' => ['page' => '\d+']
            ],
        ],
    ],
];
