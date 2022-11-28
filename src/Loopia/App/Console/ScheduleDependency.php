<?php 

namespace Loopia\App\Console;

use Loopia\App\Api\Client;
use Loopia\App\Api\FilmApiDataCache;
use Loopia\App\Api\FilmApiDataLoader;
use Loopia\App\Api\Redis;
use Loopia\App\Services\RedisService;

class ScheduleDependency {

    private array $scheduleClasses;

    public function __construct() {
        $this->itemsForCache = new FilmApiDataCache(new FilmApiDataLoader(new Client), new Redis(new RedisService()));
    }

    public function dependencyClassesForSchedule(): array {
        return $this->scheduleClasses = [
            $this->itemsForCache
        ] ?? 
        throw new \Exception("Schedule Classes injection Interface broken!");
    } 

}