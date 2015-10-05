<?php

namespace Application\Test\Helper;

use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

class ContainerFactory
{
    public function __invoke()
    {
        chdir(__DIR__ . '/../..');
        return new ServiceManager(new Config(include 'config/container.php'));
    }
}
