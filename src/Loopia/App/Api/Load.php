<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use Doctrine\Common\Collections\ArrayCollection;
use Loopia\App\Services\HttpService;
use Loopia\App\Services\RedisService;


 class Load
{
    public function __construct(protected Client $filmApiClient, protected RedisService $redisService, protected Redis $redis, protected HttpService $httpService)
    {
        $this->filmApiClient = $filmApiClient;
        $this->redisService = $redisService;
        $this->redis = $redis;
        $this->httpService = $httpService;
    }

    public function loadData() :ArrayCollection|string
    {
        try {
            if ($this->redisService->getService()->exists('/v1/items') === 1) {
                $data = $this->redis->getCache($this->redisService, '/v1/items');
            } else {
                $data = $this->getItemsRequest();
            }
            return new ArrayCollection(json_decode($data, TRUE));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function loadItemData(int $id) :ArrayCollection|string
    {
        try {
            if ($this->redisService->getService()->exists('/v1/item/' . $id) === 1) {
                $data = $this->redis->getCache($this->redisService, '/v1/item/' . $id);
            } else {
                $data = $this->getSingleItemsRequest($id);
            }
            return new ArrayCollection(json_decode($data, TRUE));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getItemsRequest(): string
    {
        return $this->filmApiClient->send($this->filmApiClient->getRequest('items'), $this->httpService)->getBody()->getContents();
    }

    public function getSingleItemsRequest($id): string
    {
        return $this->filmApiClient->send($this->filmApiClient->getRequest('items/' . $id), $this->httpService)->getBody()->getContents();
    }

    public function publicItemsRequest(): string
    {
        return $this->getItemsRequest();
    }
}