<?php

namespace Loopia\App\Console;

// $container = require_once dirname(__DIR__) . '/../../application.php';
// var_dump($container);
// exit;

use Loopia\App\Api\FilmApiDataCache;
use Loopia\App\Api\FilmApiDataMemcache;
use Loopia\App\Api\Load;
use Loopia\App\ServiceModels\Client;
use Loopia\App\ServiceModels\Memcache;
use Loopia\App\ServiceModels\Redis;
use Loopia\App\Services\HttpService;
use Loopia\App\Services\MemcacheService;
use Loopia\App\Services\RedisService;
use Loopia\App\Containers\ContainerModel;

class ScheduleDependency
{
    /**
     * @return FilmApiDataCache[]
     */
    private function dependencyClassesForScheduleRedis(): array
    {
        $container = new ContainerModel();
        return [
            $container->build()->get('FilmApiDataCache'),
        ];
    }

    /**
     * @return FilmApiDataMemcache[]
     */
    private function dependencyClassesForScheduleMemcache(): array
    {
        $container = new ContainerModel();
        return [
            $container->build()->get('FilmApiDataMemcache'),
        ];
    }

    public function redisClasses(): array {
        return $this->dependencyClassesForScheduleRedis();
    }

    public function memcacheClasses(): array {
        return $this->dependencyClassesForScheduleMemcache();
    }

}