<?php

namespace Application\Container\Action;

use Application\Action\IndexAction;
use Interop\Container\ContainerInterface;

class IndexActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $templateRenderer = $container->get('Zend\\Expressive\\Template\\TemplateRendererInterface');
        return new IndexAction($templateRenderer);
    }
}
