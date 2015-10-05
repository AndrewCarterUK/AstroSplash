<?php

namespace Application\Test\Container;

use Application\Container\CacheFactory;
use Application\Test\Helper\ContainerFactory;
use Application\Test\Helper\MockContainer;

class CacheFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage cache_path key must be set in config service
     */
    public function testMissingCachePath()
    {
        $emptyContainer = new MockContainer(['config' => array()]);
        $cacheFactory = new CacheFactory();
        $cacheFactory($emptyContainer);
    }

    public function testCacheFactory()
    {
        $containerFactory = new ContainerFactory();
        $cacheFactory = new CacheFactory();
        $this->assertInstanceof('Doctrine\\Common\\Cache\\Cache', $cacheFactory($containerFactory()));
    }
}
