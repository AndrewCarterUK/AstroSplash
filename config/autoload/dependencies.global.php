<?php

return [
    'dependencies' => [
        'factories' => [
            Zend\Expressive\Application::class => Zend\Expressive\Container\ApplicationFactory::class,
            Doctrine\Common\Cache\Cache::class => App\DoctrineCacheFactory::class,
            AndrewCarterUK\APOD\APIInterface::class => App\APIFactory::class,
        ],
    ],
    'application' => [
        'cache_path' => 'data/doctrine-cache/',
        'results_per_page' => 24,
        'apod_api' => [
            'store_path' => 'public/apod',
            'base_url' => '/apod',
        ],
    ],
];
