<?php

namespace Application\Middleware\Route;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateInterface;
use Zend\Stratigility\MiddlewareInterface;

class IndexMiddleware implements MiddlewareInterface
{
    private $templates;

    public function __construct(TemplateInterface $templates)
    {
        $this->templates = $templates;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $out     = null)
    {
        return new HtmlResponse($this->templates->render('app::index'));
    }
}
