<?php

namespace Application\Container\Middleware\Pipe;

use Application\Middleware\Pipe\RateLimitMiddleware;
use Interop\Container\ContainerInterface;

class RateLimitMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $cache  = $container->get('Doctrine\\Common\\Cache\\Cache');
        $config = $container->get('config');

        if (!is_array($config) || !isset($config['hourly_limit'])) {
            throw new \RuntimeException('hourly_limit key must be set in config service');
        }

        return new RateLimitMiddleware($cache, $config['hourly_limit']);
    }
}
