<?php 

namespace Loopia\App\Api;

use \Loopia\App\Services\RedisService;

class Redis {

    public function __construct(protected RedisService $redisService) {
        $this->redisService = $redisService;
    }

    public function setCache(string $name, string $data) {
            $this->redisService->getService()->set($name, $data)??
        throw new \Exception("Cash items broken!");
    }

    public function getCache($name) {
        return $this->redisService->getService()->get($name)??
        throw new \Exception("Cash single item broken!");
    }
}