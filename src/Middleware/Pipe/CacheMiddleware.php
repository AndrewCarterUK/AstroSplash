<?php

namespace Application\Middleware\Pipe;

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
        return 'url.'.$request->getUri()->getPath();
    }

    private function getCachedResponse(ServerRequestInterface $request, ResponseInterface $response)
    {
        if ('GET' === $request->getMethod()) {
            $item = $this->cache->fetch($this->getCacheKey($request));

            if (false !== $item) {
                $response->getBody()->write($item['body']);
                return $response->withHeader('Content-Type', $item['type']);
            }
        }

        return null;
    }

    private function cacheResponse(ServerRequestInterface $request, ResponseInterface $response)
    {
        if ('GET' === $request->getMethod() && $response->hasHeader('Cache-Control')) {
            $cacheControl = $response->getHeader('Cache-Control');

            $abortTokens = array('private', 'no-cache', 'no-store');

            if (count(array_intersect($abortTokens, $cacheControl)) > 0) {
                return;
            }

            foreach ($cacheControl as $value) {
                $parts = explode('=', $value);

                if ('max-age' === $parts[0] && count($parts) == 2) {
                    $this->cache->save($this->getCacheKey($request), [
                        'body' => (string) $response->getBody(),
                        'type' => $response->getHeaderLine('Content-Type'),
                    ], intval($parts[1]));
                }
            }
        }
    }
}
