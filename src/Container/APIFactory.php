<?php

namespace Application\Container;

use AndrewCarterUK\APOD\API;
use GuzzleHttp\Client;
use Interop\Container\ContainerInterface;

class APIFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        if (!isset($config['application']['apod_api'])) {
            throw new \RuntimeException('apod_api must be set in application configuration');
        }

        return new API(new Client, $config['application']['apod_api']);
    }
}
