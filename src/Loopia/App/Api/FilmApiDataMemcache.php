<?php

namespace Loopia\App\Api;

use Exception;
use Loopia\App\Api\ServiceModels\Load;
use Loopia\App\Api\ServiceModels\Memcache;
use Loopia\App\Interface\MemcacheDependency;
use Loopia\App\Services\MemcacheService;

class FilmApiDataMemcache implements MemcacheDependency
{

    public function __construct
    (
        protected Load            $loader,
        protected MemcacheService $memcacheService,
        protected Memcache        $memcache
    )
    {
        $this->loader = $loader;
        $this->memcacheService = $memcacheService;
        $this->memcache = $memcache;
    }

    public function memcacheDependencyClassesMethodsForCaching(): void
    {
        $this->memcacheItems();
        $this->memcacheSingleItem();
    }

    private function memcacheItems(): void
    {
        $this->memcache->setCache($this->memcacheService, '/v1/items', $this->loader->publicItemsRequest());
    }

    private function memcacheSingleItem(): void
    {
        if ($this->memcache->getCache($this->memcacheService, '/v1/items')) {
            foreach (\json_decode($this->memcache->getCache($this->memcacheService, '/v1/items'), TRUE) as $item) {
                $this->memcache->setCache($this->memcacheService, '/v1/item/' . $item['id'], \json_encode($item));
            }
        }
    }
}