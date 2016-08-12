<?php
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Zend\Expressive\Application::class => Zend\Expressive\Container\ApplicationFactory::class,
            Helper\UrlHelper::class => Helper\UrlHelperFactory::class,
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
