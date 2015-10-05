<?php

namespace Application\Container\Middleware\Route;

use Application\Middleware\Route\IndexMiddleware;
use Interop\Container\ContainerInterface;

class IndexMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $templates = $container->get('Zend\\Expressive\\Template\\TemplateInterface');
        return new IndexMiddleware($templates);
    }
}
