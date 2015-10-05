<?php

namespace Application\Container;

use Doctrine\Common\Cache\FilesystemCache;
use Interop\Container\ContainerInterface;

class CacheFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        if (!is_array($config) || !isset($config['cache_path'])) {
            throw new \RuntimeException('cache_path key must be set in config service');
        }

        return new FilesystemCache($config['cache_path']);
    }
}
