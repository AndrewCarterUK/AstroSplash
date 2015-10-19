<?php

namespace Application\Container\Action;

use Application\Action\PictureListAction;
use Interop\Container\ContainerInterface;

class PictureListActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $apodApi = $container->get('AndrewCarterUK\\APOD\\APIInterface');
        $config  = $container->get('config');

        if (!isset($config['application']['results_per_page'])) {
            throw new \RuntimeException('results_per_page must be set in application configuration');
        }

        return new PictureListAction($apodApi, $config['application']['results_per_page']);
    }
}
