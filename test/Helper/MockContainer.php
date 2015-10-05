<?php

namespace Application\Test\Helper;

use Interop\Container\ContainerInterface;

class MockContainer implements ContainerInterface
{
    private $services;

    public function __construct(array $services = [])
    {
        $this->services = $services;
    }

    public function get($id)
    {
        if (!$this->has($id)) {
            throw new \RuntimeException('Not found');
        }

        return $this->services[$id];
    }

    public function has($id)
    {
        return isset($this->services[$id]);
    }
}
