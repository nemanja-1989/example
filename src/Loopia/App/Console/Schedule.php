<?php

namespace Loopia\App\Console;

use Loopia\App\Interface\RedisDependency;

final class Schedule extends ScheduleDependency
{

    private function run(RedisDependency $redisDependency)
    {
        $redisDependency->redisDependencyClassesMethodsForCaching();
    }

    public function exe()
    {
        $classesForSchedule = $this->dependencyClassesForSchedule();
        foreach ($classesForSchedule as $class) {
            $this->run($class);
        }
    }
}