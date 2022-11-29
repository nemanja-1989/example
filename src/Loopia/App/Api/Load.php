<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use Doctrine\Common\Collections\ArrayCollection;
use Loopia\App\Constants\Constants;
use Loopia\App\Constants\Items\ItemsConstants;
use Loopia\App\ServiceModels\Client;
use Loopia\App\ServiceModels\Memcache;
use Loopia\App\ServiceModels\Redis;
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

    /**
     * @return ArrayCollection|string
     */

    public function loadData(): ArrayCollection|string
    {
        if ($this->redis->getCache($this->redisService, name: ItemsConstants::ITEMS_CACHE) !== null) {
            $data = $this->redis->getCache($this->redisService, name: ItemsConstants::ITEMS_CACHE);
        } else if ($this->memcache->getCache($this->memcacheService, name: ItemsConstants::ITEMS_CACHE) !== "") {
            $data = $this->memcache->getCache($this->memcacheService, name: ItemsConstants::ITEMS_CACHE);
        } else {
            $data = $this->getItemsRequest();
        }
        return new ArrayCollection(\json_decode($data, TRUE));
    }

    /**
     * @param int $id
     * @return ArrayCollection|string
     */

    public function loadItemData(int $id): ArrayCollection|string
    {
        if ($this->redis->getCache($this->redisService, name: ItemsConstants::itemCache($id)) !== null) {
            $data = $this->redis->getCache($this->redisService, name: ItemsConstants::itemCache($id));
        } else if ($this->memcache->getCache($this->memcacheService, name: ItemsConstants::itemCache($id)) !== "") {
            $data = $this->memcache->getCache($this->memcacheService, name: ItemsConstants::itemCache($id));
        } else {
            $data = $this->getSingleItemsRequest($id);
        }
        return new ArrayCollection(\json_decode($data, TRUE));
    }

    /**
     * @return string
     */
    private function getItemsRequest(): string
    {
        return $this->filmApiClient
            ->send($this->filmApiClient
                ->getRequest(ItemsConstants::ITEMS_URI, username: Constants::MOVIE_API_USERNAME, password: Constants::MOVIE_API_PASSWORD), $this->httpService, uri: Constants::MOVIE_URI . 'items')
            ->getBody()
            ->getContents();
    }

    /**
     * @param $id
     * @return string
     */
    private function getSingleItemsRequest($id): string
    {
        return $this->filmApiClient
            ->send($this->filmApiClient
                ->getRequest(ItemsConstants::itemUri($id), username: Constants::MOVIE_API_USERNAME, password: Constants::MOVIE_API_PASSWORD), $this->httpService, uri: Constants::MOVIE_URI . 'items')
            ->getBody()
            ->getContents();
    }

    /**
     * @return string
     */
    public function publicItemsRequest(): string
    {
        return $this->getItemsRequest();
    }
}