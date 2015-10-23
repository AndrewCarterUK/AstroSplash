<?php

chdir(__DIR__.'/..');

include 'vendor/autoload.php';

$container = include 'config/container.php';

// Create a SIGINT handler that sets a shutdown flag
$shutdown = false;

declare(ticks = 1);

pcntl_signal(SIGINT, function () use (&$shutdown) {
    $shutdown = true;    
});

$container->get(AndrewCarterUK\APOD\APIInterface::class)->updateStore(
    // New picture handler
    function (array $picture) use (&$shutdown) {
        echo 'Added: '.$picture['title'].PHP_EOL;

        // If the shutdown flag has been set, die
        if ($shutdown) {
            die;
        }
    },
    // Error handler
    function (\Exception $exception) use (&$shutdown) {
        echo (string)$exception.PHP_EOL;

        // If the shutdown flag has been set, die
        if ($shutdown) {
            die;
        }
    }
);
