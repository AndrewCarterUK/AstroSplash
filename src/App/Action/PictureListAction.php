<?php

namespace App\Action;

use AndrewCarterUK\APOD\APIInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Stratigility\MiddlewareInterface;

class PictureListAction implements MiddlewareInterface
{
    private $apodApi;
    private $resultsPerPage;

    public function __construct(APIInterface $apodApi, $resultsPerPage)
    {
        $this->apodApi        = $apodApi;
        $this->resultsPerPage = $resultsPerPage;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $out = null)
    {
        $page     = intval($request->getAttribute('page')) ?: 0;
        $pictures = $this->apodApi->getPage($page, $this->resultsPerPage);

        $response->getBody()->write(json_encode($pictures));

        return $response
            ->withHeader('Cache-Control', ['public', 'max-age=3600'])
            ->withHeader('Content-Type', 'application/json');
    }
}
