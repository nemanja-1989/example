<?php 

namespace Loopia\App\Services;

use Loopia\App\Interface\ServiceInterface;

class MemcacheService implements ServiceInterface{

    /**
     * @return \Memcached
     */
    public function getService() {
        $memcache = new \Memcached();
        $memcache->addServer(host: '127.0.0.1', port: 11211);
        return $memcache;
    }
}