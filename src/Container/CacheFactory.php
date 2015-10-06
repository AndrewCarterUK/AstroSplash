<?php

namespace Application\Container;

use Doctrine\Common\Cache\FilesystemCache;
use Interop\Container\ContainerInterface;

class CacheFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        if (!isset($config['application']['cache_path'])) {
            throw new \RuntimeException('cache_path must be set in application configuration');
        }

        return new FilesystemCache($config['application']['cache_path']);
    }
}
