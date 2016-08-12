<?php

namespace App\Action;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Stratigility\MiddlewareInterface;

class IndexAction implements MiddlewareInterface
{
    private $templateRenderer;

    public function __construct(TemplateRendererInterface $templateRenderer)
    {
        $this->templateRenderer = $templateRenderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        /* $html = $this->templateRenderer->render('app::index');
        $response->getBody()->write($html);
        return $response->withHeader('Content-Type', 'text/html'); */

        $html = $this->templateRenderer->render('app::index');
        $response->getBody()->write($html);
        return $response
                ->withHeader('Content-Type', 'text/html')
                ->withHeader('Cache-Control', ['public', 'max-age=3600']);
    }
}
