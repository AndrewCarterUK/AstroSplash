<?php

namespace Application\Container\Middleware;

use Application\Middleware\CacheMiddleware;
use Interop\Container\ContainerInterface;

class CacheMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $cache = $container->get('Doctrine\\Common\\Cache\\Cache');
        return new CacheMiddleware($cache);
    }
}
