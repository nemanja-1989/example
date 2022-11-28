<?php 

namespace Loopia\App\Services;

use Loopia\App\Interface\ServiceInterface;

class MemcacheService implements ServiceInterface{
    
    public function getService() {
        return new \Memcache();
    }
}