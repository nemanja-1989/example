<?php

namespace Loopia\App\Api\ServiceModels;

use \Loopia\App\Services\RedisService;

class Redis
{

    public function setCache(RedisService $redisService, string $name, string $data): void
    {
        $redisService->getService()->set($name, $data);
    }

    public function getCache(RedisService $redisService, $name): string|null
    {
        return $redisService->getService()->get($name);
    }
}