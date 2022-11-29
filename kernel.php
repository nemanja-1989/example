<?php

require_once dirname(__DIR__) . '/example/vendor/autoload.php';

use Loopia\App\Console\Schedule;
use Loopia\App\ServiceModels\Memcache;
use Loopia\App\ServiceModels\Redis;
use Loopia\App\Services\MemcacheService;
use Loopia\App\Services\RedisService;

$schedule = new Schedule(new RedisService, new Redis, new MemcacheService, new Memcache);
$schedule->exe();