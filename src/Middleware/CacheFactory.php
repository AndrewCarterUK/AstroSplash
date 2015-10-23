<?php

namespace App\Middleware;

use Doctrine\Common\Cache\Cache;
use Interop\Container\ContainerInterface;

class CacheFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $cache = $container->get(Cache::class);
        return new CacheMiddleware($cache);
    }
}
