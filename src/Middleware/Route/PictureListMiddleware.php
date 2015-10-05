<?php

namespace Application\Middleware\Route;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Stratigility\MiddlewareInterface;

class PictureListMiddleware implements MiddlewareInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $out     = null)
    {
        $page = intval($request->getAttribute('page')) ?: 0;

        $response->getBody()->write($page);

        $expiryTime = new \DateTime('+30 seconds');
        $ttl = $expiryTime->getTimestamp() - time();

        return $response
            ->withHeader('Cache-Control', ['public', 'max-age='.$ttl])
            ->withHeader('Content-Type', 'text/html');
    }
}
