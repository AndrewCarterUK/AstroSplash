<?php

use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

$config = [];

foreach (glob('config/container.{global,local}.php', GLOB_BRACE) as $file) {
    $config = array_replace_recursive($config, include $file);
}

return new ServiceManager(new Config($config));
