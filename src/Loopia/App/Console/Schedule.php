<?php 

namespace Loopia\App\Console;

use Loopia\App\Api\FilmApiDataCache;

class Schedule {

    public function __construct(protected FilmApiDataCache $cache) {
        $this->cache = $cache;
    }

    public function run() {
        try{
            $this->cache->redisItems();
            $this->cache->redisSingleItem();
        }catch(\Exception $e) {
            return $e->getMessage();
        }
        
    }
}