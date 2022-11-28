<?php 

namespace Loopia\App\Console;

use Loopia\App\Api\Client;
use Loopia\App\Api\FilmApiDataCache;
use Loopia\App\Api\FilmApiDataLoader;
use Loopia\App\Api\Redis;

class ScheduleDependency {

    public array $scheduleClasses;

    public function __construct() {
        $this->client = new Client;
        $this->redis = new Redis();
        $this->filmLoader = new FilmApiDataLoader($this->client);
        $this->itemsForCache = new FilmApiDataCache($this->filmLoader, $this->redis);
    }

    public function dependencyClassesForSchedule(): array {
        return $this->scheduleClasses = [
            $this->itemsForCache
        ] ?? 
        throw new \Exception("Schedule Classes injection Interface broken!");
    } 

}