<?php

namespace Loopia\App\ServiceModels;

use Loopia\App\Services\MemcacheService;

class Memcache
{

    /**
     * @param MemcacheService $memcache
     * @param string $name
     * @param string $data
     * @return void
     */
    public function setCache(MemcacheService $memcache, string $name, string $data): void
    {
        $memcache->getService()->set($name, $data);
    }

    /**
     * @param MemcacheService $memcache
     * @param $name
     * @return string|null
     */
    public function getCache(MemcacheService $memcache, $name): string|null
    {
        return $memcache->getService()->get($name);
    }
}