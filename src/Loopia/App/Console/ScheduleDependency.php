<?php

namespace Loopia\App\Console;

use Loopia\App\Api\Client;
use Loopia\App\Api\FilmApiDataCache;
use Loopia\App\Api\Load;
use Loopia\App\Api\Redis;
use Loopia\App\Services\HttpService;
use Loopia\App\Services\RedisService;

class ScheduleDependency
{

    public function dependencyClassesForSchedule(): array
    {
        return [
            new FilmApiDataCache(new Load(new Client, new RedisService, new Redis, new HttpService), new RedisService, new Redis),
        ];
    }

}