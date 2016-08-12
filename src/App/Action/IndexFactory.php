<?php

namespace App\Action;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class IndexFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $templateRenderer = $container->get(TemplateRendererInterface::class);
        return new IndexAction($templateRenderer);
    }
}
