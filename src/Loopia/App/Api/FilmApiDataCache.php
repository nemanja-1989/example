<?php

namespace Loopia\App\Api;

use Exception;
use Loopia\App\Interface\RedisDependency;
use Loopia\App\Services\RedisService;
use Loopia\App\Api\ServiceModels\Load;
use Loopia\App\Api\ServiceModels\Redis;

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
        $this->redis->setCache($this->redisService, '/v1/items', $this->loader->publicItemsRequest());
    }

    private function redisSingleItem(): void
    {
        if ($this->redis->getCache($this->redisService, '/v1/items')) {
            foreach (\json_decode($this->redis->getCache($this->redisService, '/v1/items'), TRUE) as $item) {
                $this->redis->setCache($this->redisService, '/v1/item/' . $item['id'], \json_encode($item));
            }
        }
    }
}