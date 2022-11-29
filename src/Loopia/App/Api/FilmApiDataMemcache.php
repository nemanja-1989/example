<?php

namespace Loopia\App\Api;

use Loopia\App\Constants\Items\ItemsConstants;
use Loopia\App\Interface\MemcacheDependency;
use Loopia\App\ServiceModels\Memcache;
use Loopia\App\Services\MemcacheService;

class FilmApiDataMemcache implements MemcacheDependency
{

    /**
     * @param Load $loader
     * @param MemcacheService $memcacheService
     * @param Memcache $memcache
     */
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
        $this->memcache->setCache($this->memcacheService, name:ItemsConstants::ITEMS_CACHE, data: $this->loader->publicItemsRequest());
    }

    private function memcacheSingleItem(): void
    {
        if ($this->memcache->getCache($this->memcacheService, name: ItemsConstants::ITEMS_CACHE)) {
            foreach (\json_decode($this->memcache->getCache($this->memcacheService, name: ItemsConstants::ITEMS_CACHE), TRUE) as $item) {
                $this->memcache->setCache($this->memcacheService, name: ItemsConstants::itemCache($item['id']), data: \json_encode($item));
            }
        }
    }
}