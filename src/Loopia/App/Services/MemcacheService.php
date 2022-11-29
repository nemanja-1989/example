<?php 

namespace Loopia\App\Services;

use Loopia\App\Interface\ServiceInterface;

class MemcacheService implements ServiceInterface{
    
    public function getService() {
        $memcache = new \Memcached();
        $memcache->addServer('127.0.0.1', 11211);
        return $memcache;
    }
}