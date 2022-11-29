<?php 

namespace Loopia\App\Services;

use Loopia\App\Interface\ServiceInterface;
use Predis\Client;
use Predis\ClientInterface;

class RedisService implements ServiceInterface{

    /**
     * @return Client
     */
    public function getService() :Client {
        return new \Predis\Client();
    }
}