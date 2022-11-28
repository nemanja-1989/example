<?php

namespace Loopia\App\Api;

use \Loopia\App\Services\RedisService;

class Redis
{

    public function setCache(RedisService $redisService, string $name, string $data)
    {
        $redisService->getService()->set($name, $data);
    }

    public function getCache(RedisService $redisService, $name): string
    {
        return $redisService->getService()->get($name);
    }
}