<?php

namespace App\Middleware;

use Doctrine\Common\Cache\Cache;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Stratigility\MiddlewareInterface;

class CacheMiddleware implements MiddlewareInterface
{
    private $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $cachedResponse = $this->getCachedResponse($request, $response);

        if (null !== $cachedResponse) {
            return $cachedResponse;
        }

        $response = $next($request, $response);

        $this->cacheResponse($request, $response);

        return $response;
    }

    private function getCacheKey(ServerRequestInterface $request)
    {
        return 'http-cache:'.$request->getUri()->getPath();
    }

    private function getCachedResponse(ServerRequestInterface $request, ResponseInterface $response)
    {
        if ('GET' !== $request->getMethod()) {
            return null;
        }

        $item = $this->cache->fetch($this->getCacheKey($request));

        if (false === $item) {
            return null;
        }

        $response->getBody()->write($item['body']);

        foreach ($item['headers'] as $name => $value) {
            $response = $response->withHeader($name, $value);
        }

        return $response;
    }

    private function cacheResponse(ServerRequestInterface $request, ResponseInterface $response)
    {
        if ('GET' !== $request->getMethod() || !$response->hasHeader('Cache-Control')) {
            return;
        }

        $cacheControl = $response->getHeader('Cache-Control');

        $abortTokens = ['private', 'no-cache', 'no-store'];

        if (count(array_intersect($abortTokens, $cacheControl)) > 0) {
            return;
        }

        foreach ($cacheControl as $value) {
            $parts = explode('=', $value);

            if (count($parts) == 2 && 'max-age' === $parts[0]) {
                $this->cache->save($this->getCacheKey($request), [
                    'body'    => (string) $response->getBody(),
                    'headers' => $response->getHeaders(),
                ], intval($parts[1]));

                return;
            }
        }
    }
}
