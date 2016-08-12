<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
        ],
        'factories' => [
            App\Action\IndexAction::class => App\Action\IndexFactory::class,
            App\Action\PictureListAction::class => App\Action\PictureListFactory::class,
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
            'name' => 'picture-list',
            'path' => '/picture-list[/{page:\d+}]',
            'middleware' => App\Action\PictureListAction::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
