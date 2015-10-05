<?php

use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

chdir(__DIR__.'/..');

include 'vendor/autoload.php';

$container = new ServiceManager(new Config(include 'config/container.php'));

$container->get('Zend\\Expressive\\Application')->run();
