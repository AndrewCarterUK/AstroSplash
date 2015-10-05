<?php

namespace Application\Middleware\Pipe;

use Doctrine\Common\Cache\Cache;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Stratigility\MiddlewareInterface;

class RateLimitMiddleware implements MiddlewareInterface
{
    private $cache;
    private $hourlyLimit;

    public function __construct(Cache $cache, $hourlyLimit)
    {
        $this->cache       = $cache;
        $this->hourlyLimit = $hourlyLimit;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $hits = $this->getHits($request);

        if (count($hits) > $this->hourlyLimit) {
            $response->getBody()->write('Rate limit exceeded');

            return $response->withStatus(429);
        }

        $response = $next($request, $response);

        $hits[] = time();
        $this->saveHits($request, $hits);

        return $response;
    }

    private function getCacheKey(ServerRequestInterface $request)
    {
        return $request->getServerParams()['REMOTE_ADDR'];
    }

    private function getHits(ServerRequestInterface $request)
    {
        $hits = $this->cache->fetch($this->getCacheKey($request));

        if (false === $hits) {
            return array();
        }

        // Remove all hits not within the last hour
        return array_filter($hits, function ($time) {
            return $time > time() - 3600;
        });
    }

    private function saveHits(ServerRequestInterface $request, array $hits)
    {
        $this->cache->save($this->getCacheKey($request), $hits, 3600);
    }
}
