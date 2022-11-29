<?php

namespace Loopia\App\Console;

use Loopia\App\Api\FilmApiDataCache;
use Loopia\App\Api\FilmApiDataMemcache;
use Loopia\App\Api\Load;
use Loopia\App\ServiceModels\Client;
use Loopia\App\ServiceModels\Memcache;
use Loopia\App\ServiceModels\Redis;
use Loopia\App\Services\HttpService;
use Loopia\App\Services\MemcacheService;
use Loopia\App\Services\RedisService;

class ScheduleDependency
{

    /**
     * @return FilmApiDataCache[]
     */
    private function dependencyClassesForScheduleRedis(): array
    {
        return [
            new FilmApiDataCache(new Load(new Client, new RedisService, new Redis, new HttpService, new MemcacheService, new Memcache), new RedisService, new Redis),
        ];
    }

    /**
     * @return FilmApiDataMemcache[]
     */
    private function dependencyClassesForScheduleMemcache(): array
    {
        return [
            new FilmApiDataMemcache(new Load(new Client, new RedisService, new Redis, new HttpService, new MemcacheService, new Memcache), new MemcacheService, new Memcache),
        ];
    }

    public function redisClasses(): array {
        return $this->dependencyClassesForScheduleRedis();
    }

    public function memcacheClasses(): array {
        return $this->dependencyClassesForScheduleMemcache();
    }

}