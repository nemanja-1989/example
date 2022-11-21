<?php 

namespace Loopia\App\Services;

use Loopia\App\Interface\ServiceInterface;
class RedisService implements ServiceInterface{
    
    public function getService() {
        return new \Predis\Client();
    }
}