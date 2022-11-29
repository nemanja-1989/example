<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use Doctrine\Common\Collections\ArrayCollection;
use Loopia\App\Interface\ResponseInterface;
use Loopia\App\Interface\ResponseSingleInterface;
use Loopia\App\ServiceModels\Client;
use Loopia\App\ServiceModels\Memcache;
use Loopia\App\ServiceModels\Redis;
use Loopia\App\Services\HttpService;
use Loopia\App\Services\MemcacheService;
use Loopia\App\Services\RedisService;


class FilmApiDataLoader implements ResponseInterface, ResponseSingleInterface
{

    /**
     * @return Load
     */
    private function getLoadClass(): Load
    {
        return new Load(new Client, new RedisService, new Redis, new HttpService, new MemcacheService, new Memcache);
    }

    /**
     * @return ArrayCollection|string
     */
    public function getResponse(): ArrayCollection|string
    {
        return $this->getLoadClass()->loadData();
    }

    /**
     * @param $id
     * @return ArrayCollection|string
     */
    public function getById($id): ArrayCollection|string
    {
        return $this->getLoadClass()->loadItemData($id);
    }
}
