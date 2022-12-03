<?php

namespace Loopia\App\Console;

// $container = require_once dirname(__DIR__) . '/../../application.php';
// var_dump($container);
// exit;

use Loopia\App\Api\FilmApiDataCache;
use Loopia\App\Api\FilmApiDataMemcache;
use Loopia\App\Containers\ContainerModel;

class ScheduleDependency
{
    public function __construct(protected ContainerModel $container) {
        $this->container = $container;
    }
    /**
     * @return FilmApiDataCache[]
     */
    private function dependencyClassesForScheduleRedis(): array
    {
        // $container = new ContainerModel();
        return [
            $this->container->build()->get('FilmApiDataCache'),
        ];
    }

    /**
     * @return FilmApiDataMemcache[]
     */
    private function dependencyClassesForScheduleMemcache(): array
    {
        // $container = new ContainerModel();
        return [
            $this->container->build()->get('FilmApiDataMemcache'),
        ];
    }

    public function redisClasses(): array {
        return $this->dependencyClassesForScheduleRedis();
    }

    public function memcacheClasses(): array {
        return $this->dependencyClassesForScheduleMemcache();
    }

}