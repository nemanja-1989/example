<?php 

namespace Loopia\App\Services;

use Loopia\App\Interface\ServiceInterface;

class MemcacheService implements ServiceInterface{
    
    public function getService() {
        $memcache = new \Memcache();
        $memcache->addServer('127.0.0.1', 11211);
        return $memcache;
    }
}