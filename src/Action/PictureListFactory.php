<?php

namespace App\Action;

use AndrewCarterUK\APOD\APIInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

class PictureListFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $apodApi = $container->get(APIInterface::class);
        $config  = $container->get('config');

        if (!isset($config['application']['results_per_page'])) {
            throw new ServiceNotCreatedException('results_per_page must be set in application configuration');
        }

        return new PictureListAction($apodApi, $config['application']['results_per_page']);
    }
}
