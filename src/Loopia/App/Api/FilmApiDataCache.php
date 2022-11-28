<?php

namespace Loopia\App\Api;

use Exception;
use Loopia\App\Api\FilmApiDataLoader;
use Loopia\App\Interface\RedisDependency;
use Loopia\App\Services\RedisService;

class FilmApiDataCache implements RedisDependency
{

    public function __construct(protected FilmApiDataLoader $loader, protected RedisService $redisService, protected Redis $redis)
    {
        $this->loader = $loader;
        $this->redisService = $redisService;
        $this->redis = $redis;
    }

    public function redisDependencyClassesMethodsForCaching()
    {
        $this->redisItems();
        $this->redisSingleItem();
    }

    private function redisItems()
    {
        $this->redis->setCache($this->redisService, '/v1/items', $this->loader->publicItemsRequest());
    }

    private function redisSingleItem()
    {
        if ($this->redis->getCache($this->redisService, '/v1/items')) {
            foreach (json_decode($this->redis->getCache($this->redisService, '/v1/items'), TRUE) as $item) {
                $this->redis->setCache($this->redisService, '/v1/item/' . $item['id'], json_encode($item));
            }
        }
    }
}