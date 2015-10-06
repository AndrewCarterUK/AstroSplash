<?php

chdir(__DIR__.'/..');

include 'vendor/autoload.php';

$container = include 'config/container.php';

$container->get('AndrewCarterUK\\APOD\\APIInterface')->updateStore(
    function (array $picture) {
        echo 'Added: '.$picture['title'].PHP_EOL;
    },
    function (\Exception $exception) {
        echo (string)$exception.PHP_EOL;
    }
);
