<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api\ServiceModels;

use Doctrine\Common\Collections\ArrayCollection;
use Loopia\App\Services\HttpService;
use Loopia\App\Services\MemcacheService;
use Loopia\App\Services\RedisService;


 class Load
{
    public function __construct
    (
        protected Client $filmApiClient, 
        protected RedisService $redisService, 
        protected Redis $redis, 
        protected HttpService $httpService,
        protected MemcacheService $memcacheService,
        protected Memcache $memcache
    )
    {
        $this->filmApiClient = $filmApiClient;
        $this->redisService = $redisService;
        $this->redis = $redis;
        $this->httpService = $httpService;
        $this->memcacheService = $memcacheService;
        $this->memcache = $memcache;
    }

    public function loadData() :ArrayCollection|string
    {  
        if($this->redis->getCache($this->redisService, '/v1/items') !== null) {
            $data = $this->redis->getCache($this->redisService, '/v1/items');
        }else if($this->memcache->getCache($this->memcacheService, '/v1/items') !== null) {
            $data = $this->memcache->getCache($this->memcacheService, '/v1/items');
        }else {
            $data = $this->getItemsRequest();
        }
        return new ArrayCollection(json_decode($data, TRUE));
    }

     public function loadItemData(int $id) :ArrayCollection|string
    {   
        if($this->redis->getCache($this->redisService, '/v1/item/' . $id) !== null) {
            $data = $this->redis->getCache($this->redisService, '/v1/item/' . $id);
        }else if($this->memcache->getCache($this->memcacheService, '/v1/item/' . $id) !== null) {
            $data = $this->memcache->getCache($this->memcacheService, '/v1/item/' . $id);
        }else {
            $data = $this->getSingleItemsRequest($id);
        }
        return new ArrayCollection(json_decode($data, TRUE));    
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