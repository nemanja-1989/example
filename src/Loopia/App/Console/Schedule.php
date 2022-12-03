<?php

namespace Loopia\App\Console;

use Loopia\App\Constants\Items\ItemsConstants;
use Loopia\App\Containers\ScheduleContainer;
use Loopia\App\Interface\MemcacheDependency;
use Loopia\App\Interface\RedisDependency;
use Loopia\App\ServiceModels\Memcache;
use Loopia\App\ServiceModels\Redis;
use Loopia\App\Services\MemcacheService;
use Loopia\App\Services\RedisService;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class Schedule extends ScheduleDependency
{

    /**
     * @param ContainerModel $model;
     * @param RedisService $redisService
     * @param Redis $redis
     * @param MemcacheService $memcacheService
     * @param Memcache $memcache
     */
    public function __construct
    (
        protected RedisService $redisService,
        protected Redis $redis,
        protected MemcacheService $memcacheService,
        protected Memcache $memcache,
    )
    {
        $this->redisService = $redisService;
        $this->redis = $redis;
        $this->memcacheService = $memcacheService;
        $this->memcache = $memcache;
    }
    /**
     * @param RedisDependency $redisDependency
     * @return void
     */
    private function runRedis(RedisDependency $redisDependency) :void
    {
        $redisDependency->redisDependencyClassesMethodsForCaching();
    }

    /**
     * @param MemcacheDependency $memcacheDependency
     * @return void
     */
    private function runMemcache(MemcacheDependency $memcacheDependency) :void
    {
        $memcacheDependency->memcacheDependencyClassesMethodsForCaching();
    }

    /**
     * @return void
     */
    public function exe() :void
    {
        if($this->checkMemcache() === false || $this->checkRedisCache() === false) {
            foreach ($this->redisClasses() as $class) {
                $this->runRedis($class);
            }
            if($this->checkRedisCache() === false) {
                foreach ($this->memcacheClasses() as $class) {
                    $this->runMemcache($class);
                }
            }
        }
    }

    private function checkRedisCache() :bool {
        if($this->redis->getCache($this->redisService,  name: ItemsConstants::ITEMS_CACHE) === null) {
            return true;
        }
        return false;
    }

    private function checkMemcache() :bool {
        if($this->memcache->getCache($this->memcacheService, name: ItemsConstants::ITEMS_CACHE) === null) {
            return true;
        }
        return false;
    }
}