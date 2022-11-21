<?php 

namespace Loopia\App\Api;

use \Loopia\App\Services\RedisService;

class Redis extends RedisService {

    public function setCache(string $name, string $data) {
        $this->getService()->set($name, $data);
    }

    public function getCache($name) {
        return $this->getService()->get($name);
    }
}