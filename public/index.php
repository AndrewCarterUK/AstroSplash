<?php

chdir(__DIR__.'/..');

include 'vendor/autoload.php';

$container = include 'config/container.php';
$container->get('Zend\\Expressive\\Application')->run();

