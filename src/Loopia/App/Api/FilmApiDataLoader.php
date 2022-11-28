<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use Doctrine\Common\Collections\ArrayCollection;
use Loopia\App\Api\ServiceModels\Client;
use Loopia\App\Api\ServiceModels\Load;
use Loopia\App\Api\ServiceModels\Memcache;
use Loopia\App\Api\ServiceModels\Redis;
use Loopia\App\Interface\ResponseInterface;
use Loopia\App\Interface\ResponseSingleInterface;
use Loopia\App\Services\HttpService;
use Loopia\App\Services\MemcacheService;
use Loopia\App\Services\RedisService;


class FilmApiDataLoader implements ResponseInterface, ResponseSingleInterface
{

    private function getLoadClass() :Load
    {
        return new Load(new Client, new RedisService, new Redis, new HttpService, new MemcacheService, new Memcache);
    }

    public function getResponse() :ArrayCollection|string
    {
        return $this->getLoadClass()->loadData();
    }

    public function getById($id) :ArrayCollection|string
    {
        return $this->getLoadClass()->loadItemData($id);
    }
}
