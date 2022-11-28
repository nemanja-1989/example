<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use Doctrine\Common\Collections\ArrayCollection;
use Loopia\App\Interface\ResponseInterface;
use Loopia\App\Interface\ResponseSingleInterface;
use Loopia\App\Services\HttpService;
use Loopia\App\Services\RedisService;


class FilmApiDataLoader implements ResponseInterface, ResponseSingleInterface
{

    public function __construct(protected Client $filmApiClient)
    {
        $this->filmApiClient = $filmApiClient;
    }

    public function getResponse() :ArrayCollection|string
    {
        return $this->loadData(new RedisService, new Redis);
    }

    public function getById($id) :ArrayCollection|string
    {
        return $this->loadItemData($id, new RedisService, new Redis);
    }

    private function loadData(RedisService $redisService, Redis $redis)
    {
        try {
            if ($redisService->getService()->exists('/v1/items') === 1) {
                $data = $redis->getCache($redisService, '/v1/items');
            } else {
                $data = $this->getItemsRequest();
            }
            return new ArrayCollection(json_decode($data, TRUE));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function loadItemData(int $id, RedisService $redisService, Redis $redis)
    {
        try {
            if ($redisService->getService()->exists('/v1/item/' . $id) === 1) {
                $data = $redis->getCache($redisService, '/v1/item/' . $id);
            } else {
                $data = $this->getSingleItemsRequest($id);
            }
            return new ArrayCollection(json_decode($data, TRUE));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function getItemsRequest(): string
    {
        return $this->filmApiClient->send($this->filmApiClient->getRequest('items'), new HttpService)->getBody()->getContents();
    }

    private function getSingleItemsRequest($id): string
    {
        return $this->filmApiClient->send($this->filmApiClient->getRequest('items/' . $id), new HttpService)->getBody()->getContents();
    }

    public function publicItemsRequest(): string
    {
        return $this->getItemsRequest();
    }
}
