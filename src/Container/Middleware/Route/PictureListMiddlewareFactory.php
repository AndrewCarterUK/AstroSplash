<?php

namespace Application\Container\Middleware\Route;

use Application\Middleware\Route\PictureListMiddleware;
use Interop\Container\ContainerInterface;

class PictureListMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $apodApi = $container->get('AndrewCarterUK\\APOD\\APIInterface');
        $config  = $container->get('config');

        if (!isset($config['application']['results_per_page'])) {
            throw new \RuntimeException('results_per_page must be set in application configuration');
        }

        return new PictureListMiddleware($apodApi, $config['application']['results_per_page']);
    }
}
