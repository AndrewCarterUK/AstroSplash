<?php

use PHPFastCGI\FastCGIDaemon\ApplicationFactory;
use PHPFastCGI\Adapter\Expressive\ApplicationWrapper;

chdir(__DIR__);
require 'vendor/autoload.php';

$container = require 'config/container.php';
$app = $container->get('Zend\Expressive\Application');
$kernel = new ApplicationWrapper($app);

$consoleApplication = (new ApplicationFactory)->createApplication($kernel);
$consoleApplication->run();
