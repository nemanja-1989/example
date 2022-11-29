<?php

namespace Loopia\App\Console;

use Loopia\App\Interface\MemcacheDependency;
use Loopia\App\Interface\RedisDependency;

final class Schedule extends ScheduleDependency
{

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

    public function exe() :void
    {
        foreach ($this->dependencyClassesForScheduleRedis() as $class) {
            $this->runRedis($class);
        }
        foreach ($this->dependencyClassesForScheduleMemcache() as $class) {
            $this->runMemcache($class);
        }
    }
}