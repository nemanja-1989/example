<?php 

namespace Loopia\App\Api;

use Exception;
use Loopia\App\Api\FilmApiDataLoader;

class FilmApiDataCache extends Redis {

    public function __construct(protected FilmApiDataLoader $loader) {
        $this->loader = $loader;
    }

    public function redisItems() {
        $this->setCache('/v1/items', $this->loader->getItemsRequest())??
        throw new \Exception("Cash items broken!");
    }

    public function redisSingleItem() {
        if($this->getCache('/v1/items')) {
            foreach(json_decode($this->getCache('/v1/items'), TRUE) as $item) {
                $this->setCache('/v1/item/' . $item['id'], json_encode($item))??
                throw new \Exception("Cash items broken!");
            }
        }
    }
}