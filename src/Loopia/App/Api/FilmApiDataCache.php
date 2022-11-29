<?php

namespace Loopia\App\Api;

use Loopia\App\Constants\Items\ItemsConstants;
use Loopia\App\Interface\RedisDependency;
use Loopia\App\ServiceModels\Redis;
use Loopia\App\Services\RedisService;

class FilmApiDataCache implements RedisDependency
{

    /**
     * @param Load $loader
     * @param RedisService $redisService
     * @param Redis $redis
     */
    public function __construct
    (
        protected Load         $loader,
        protected RedisService $redisService,
        protected Redis        $redis
    )
    {
        $this->loader = $loader;
        $this->redisService = $redisService;
        $this->redis = $redis;
    }

    public function redisDependencyClassesMethodsForCaching(): void
    {
        $this->redisItems();
        $this->redisSingleItem();
    }

    private function redisItems(): void
    {
        $this->redis->setCache($this->redisService, name: ItemsConstants::ITEMS_CACHE, data: $this->loader->publicItemsRequest());
    }

    private function redisSingleItem(): void
    {
        if ($this->redis->getCache($this->redisService, name: ItemsConstants::ITEMS_CACHE)) {
            foreach (\json_decode($this->redis->getCache($this->redisService, name: ItemsConstants::ITEMS_CACHE), TRUE) as $item) {
                $this->redis->setCache($this->redisService, name: ItemsConstants::itemCache($item['id']), data: \json_encode($item));
            }
        }
    }
}