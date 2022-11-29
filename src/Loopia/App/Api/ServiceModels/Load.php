<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api\ServiceModels;

use Doctrine\Common\Collections\ArrayCollection;
use Loopia\App\Constants\Items\ItemsConstants;
use Loopia\App\Services\HttpService;
use Loopia\App\Services\MemcacheService;
use Loopia\App\Services\RedisService;


class Load
{
    /**
     * @param Client $filmApiClient
     * @param RedisService $redisService
     * @param Redis $redis
     * @param HttpService $httpService
     * @param MemcacheService $memcacheService
     * @param Memcache $memcache
     */
    public function __construct
    (
        protected Client          $filmApiClient,
        protected RedisService    $redisService,
        protected Redis           $redis,
        protected HttpService     $httpService,
        protected MemcacheService $memcacheService,
        protected Memcache        $memcache
    )
    {
        $this->filmApiClient = $filmApiClient;
        $this->redisService = $redisService;
        $this->redis = $redis;
        $this->httpService = $httpService;
        $this->memcacheService = $memcacheService;
        $this->memcache = $memcache;
    }

    public function loadData(): ArrayCollection|string
    {
        if ($this->redis->getCache($this->redisService, ItemsConstants::ITEMS) !== null) {
            var_dump(1);
            $data = $this->redis->getCache($this->redisService, ItemsConstants::ITEMS);
        } else if ($this->memcache->getCache($this->memcacheService, ItemsConstants::ITEMS) !== "") {
            $data = $this->memcache->getCache($this->memcacheService, ItemsConstants::ITEMS);
        } else {
            $data = $this->getItemsRequest();
        }
        return new ArrayCollection(\json_decode($data, TRUE));
    }

    public function loadItemData(int $id): ArrayCollection|string
    {
        if ($this->redis->getCache($this->redisService, ItemsConstants::item($id)) !== null) {
            $data = $this->redis->getCache($this->redisService, ItemsConstants::item($id));
        } else if ($this->memcache->getCache($this->memcacheService, ItemsConstants::item($id)) !== "") {
            $data = $this->memcache->getCache($this->memcacheService, ItemsConstants::item($id));
        } else {
            $data = $this->getSingleItemsRequest($id);
        }
        return new ArrayCollection(\json_decode($data, TRUE));
    }

    private function getItemsRequest(): string
    {
        return $this->filmApiClient->send($this->filmApiClient->getRequest('items'), $this->httpService)->getBody()->getContents();
    }

    private function getSingleItemsRequest($id): string
    {
        return $this->filmApiClient->send($this->filmApiClient->getRequest('items/' . $id), $this->httpService)->getBody()->getContents();
    }

    public function publicItemsRequest(): string
    {
        return $this->getItemsRequest();
    }
}