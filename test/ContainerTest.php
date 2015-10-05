<?php

namespace Application\Test\Container;

use Application\Test\Helper\ContainerFactory;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testClassServices()
    {
        $containerFactory = new ContainerFactory();
        $container = $containerFactory();

        $classServices = [
            'Application\\Middleware\\Route\\IndexMiddleware',
            'Application\\Middleware\\Pipe\\CacheMiddleware',
            'Application\\Middleware\\Pipe\\RateLimitMiddleware',
            'Doctrine\\Common\\Cache\\Cache',
            'Zend\\Expressive\\Application',
            'Zend\\Expressive\\FinalHandler',
            'Zend\\Expressive\\Router\\RouterInterface',
            'Zend\\Expressive\\Template\\TemplateInterface',
        ];

        foreach ($classServices as $classService) {
            echo $classService . PHP_EOL;
            $this->assertInstanceOf($classService, $container->get($classService));
        }
    }
}
