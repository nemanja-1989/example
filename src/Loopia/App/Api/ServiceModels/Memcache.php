<?php

namespace Loopia\App\Api\ServiceModels;

use Loopia\App\Services\MemcacheService;

class Memcache
{

    public function setCache(MemcacheService $memcache, string $name, string $data): void
    {
        $memcache->getService()->set($name, $data);
    }

    public function getCache(MemcacheService $memcache, $name): string|null
    {
        return $memcache->getService()->get($name);
    }
}