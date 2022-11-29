<?php

namespace Loopia\App\Api\ServiceModels;

use \Loopia\App\Services\RedisService;

class Redis
{

    /**
     * @param RedisService $redisService
     * @param string $name
     * @param string $data
     * @return void
     */
    public function setCache(RedisService $redisService, string $name, string $data): void
    {
        $redisService->getService()->set($name, $data);
    }

    /**
     * @param RedisService $redisService
     * @param $name
     * @return string|null
     */
    public function getCache(RedisService $redisService, $name): string|null
    {
        return $redisService->getService()->get($name);
    }
}