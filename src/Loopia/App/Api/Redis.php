<?php 

namespace Loopia\App\Api;

use \Loopia\App\Services\RedisService;

class Redis {

    public function setCache(RedisService $redisService, string $name, string $data) {
            $redisService->getService()->set($name, $data)??
        throw new \Exception("Cash items broken!");
    }

    public function getCache(RedisService $redisService, $name) {
        return $redisService->getService()->get($name)??
        throw new \Exception("Cash single item broken!");
    }
}