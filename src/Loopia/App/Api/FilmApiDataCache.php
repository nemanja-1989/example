<?php 

namespace Loopia\App\Api;

use Exception;
use Loopia\App\Api\FilmApiDataLoader;
use Loopia\App\Interface\RedisDependency;

class FilmApiDataCache implements RedisDependency {

    public function __construct(protected FilmApiDataLoader $loader, protected Redis $redis) {
        $this->loader = $loader;
        $this->redis = $redis;
    }

    public function redisDependencyClassesMethodsForCaching() {
        $this->redisItems();
        $this->redisSingleItem();
    }

    private function redisItems() {
        try{
            $this->redis->setCache('/v1/items', $this->loader->getItemsRequest());
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    private function redisSingleItem() {
        if($this->redis->getCache('/v1/items')) {
            foreach(json_decode($this->redis->getCache('/v1/items'), TRUE) as $item) {
                try{
                    $this->redis->setCache('/v1/item/' . $item['id'], json_encode($item));
                }catch(\Exception $e) {
                    return $e->getMessage();
                } 
            }
        }
    }
}