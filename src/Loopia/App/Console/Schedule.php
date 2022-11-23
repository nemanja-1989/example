<?php 

namespace Loopia\App\Console;

require_once dirname(__DIR__) . '/../../../vendor/autoload.php';

use Loopia\App\Interface\RedisDependency;

class Schedule extends ScheduleDependency {

    private function run(RedisDependency $redisDependency) {
        $redisDependency->redisDependencyClassesMethodsForCaching();
    }

    public function exe() {
        $classesForSchedule = $this->dependencyClassesForSchedule();
        foreach($classesForSchedule as $class) {
            $this->run($class);
        }
    }
}