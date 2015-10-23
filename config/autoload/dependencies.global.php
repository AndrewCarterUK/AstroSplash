<?php

return [
    'dependencies' => [
        'factories' => [
            App\Action\IndexAction::class => App\Action\IndexFactory::class,
            Zend\Expressive\Application::class => Zend\Expressive\Container\ApplicationFactory::class,
            App\Middleware\CacheMiddleware::class => App\Middleware\CacheFactory::class,
            Doctrine\Common\Cache\Cache::class => App\DoctrineCacheFactory::class,
            App\Action\PictureListAction::class => App\Action\PictureListFactory::class,
            AndrewCarterUK\APOD\APIInterface::class => App\APIFactory::class,
        ],
    ],
    'application' => [
        'cache_path' => 'doctrine-cache',
        'results_per_page' => 24,
        'apod_api' => [
            'store_path' => 'public/apod',
            'base_url' => '/apod',
        ],
    ],
];
