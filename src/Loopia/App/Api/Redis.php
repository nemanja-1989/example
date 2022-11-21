<?php 

namespace Loopia\App\Api;

use \Loopia\App\Services\RedisService;

class Redis {
    private RedisService $redis;

    public function __construct() {
        $this->redis = new RedisService;
    }

    private function cacheItems() {
        $items = json_decode($this->item->getItems(), TRUE);
        $this->iterateItems($items);
    }

    private function iterateItems($items) {
        foreach($items as $item) {
            $this->redis->getService()->set('/v1/items/' . $item['id'] , json_encode($item));
        }
    }

    public function redis() {
        return $this->cacheItems();
    }
}