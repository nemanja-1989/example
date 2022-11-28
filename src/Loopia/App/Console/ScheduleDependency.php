<?php

namespace Loopia\App\Console;

use Loopia\App\Api\ServiceModels\Client;
use Loopia\App\Api\FilmApiDataCache;
use Loopia\App\Api\FilmApiDataMemcache;
use Loopia\App\Api\ServiceModels\Memcache;
use Loopia\App\Api\ServiceModels\Redis;
use Loopia\App\Api\ServiceModels\Load as ServiceModelsLoad;
use Loopia\App\Services\HttpService;
use Loopia\App\Services\MemcacheService;
use Loopia\App\Services\RedisService;
use Loopia\App\Api\ServiceModels\Load;

class ScheduleDependency
{

    protected function dependencyClassesForScheduleRedis(): array
    {
        return [
            new FilmApiDataCache(new Load(new Client, new RedisService, new Redis, new HttpService, new MemcacheService, new Memcache), new RedisService, new Redis),
        ];
    }

    protected function dependencyClassesForScheduleMemcache(): array
    {
        return [
            new FilmApiDataMemcache(new Load(new Client, new RedisService, new Redis, new HttpService, new MemcacheService, new Memcache), new MemcacheService, new Memcache),
        ];
    }

}