<?php

namespace Loopia\App\Console;

use Loopia\App\Interface\MemcacheDependency;
use Loopia\App\Interface\RedisDependency;

final class Schedule extends ScheduleDependency
{

    private function runRedis(RedisDependency $redisDependency)
    {
        $redisDependency->redisDependencyClassesMethodsForCaching();
    }

    private function runMemcache(MemcacheDependency $memcacheDependency)
    {
        $memcacheDependency->memcacheDependencyClassesMethodsForCaching();
    }

    public function exe()
    {
        foreach ($this->dependencyClassesForScheduleRedis() as $class) {
            $this->runRedis($class);
        }
        foreach ($this->dependencyClassesForScheduleMemcache() as $class) {
            $this->runMemcache($class);
        }
    }
}