<?php 

namespace Loopia\App\Console;

use Loopia\App\Api\Client;
use Loopia\App\Api\FilmApiDataCache;
use Loopia\App\Api\FilmApiDataLoader;
use Loopia\App\Services\HttpService;

class ScheduleDependency {

    public array $scheduleClasses;

    public function __construct() {
        $this->httpService = new HttpService;
        $this->client = new Client($this->httpService);
        $this->filmLoader = new FilmApiDataLoader($this->client);
        $this->itemsForCache = new FilmApiDataCache($this->filmLoader);
    }

    public function dependencyClassesForSchedule(): array {
        return $this->scheduleClasses = [
            $this->itemsForCache
        ] ?? 
        throw new \Exception("Schedule Classes injection Interface broken!");
    } 

}