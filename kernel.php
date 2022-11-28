<?php

require_once dirname(__DIR__) . '/example/vendor/autoload.php';

use Loopia\App\Console\Schedule;
$schedule = new Schedule();
$schedule->exe();