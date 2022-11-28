<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use Doctrine\Common\Collections\ArrayCollection;
use \Loopia\App\Api\Redis;
use Loopia\App\Services\HttpService;
use Loopia\App\Services\RedisService;

class FilmApiDataLoader {

	public function __construct(protected Client $filmApiClient) {
		$this->filmApiClient = $filmApiClient;
	}

	public function loadData(RedisService $redisService, Redis $redis) {
		try{
			if($redisService->getService()->exists('/v1/items') === 1){
				$data = $redis->getCache($redisService,'/v1/items');
			}else {
				$data = $this->getItemsRequest();
			}
			return new ArrayCollection(json_decode($data, TRUE));
		}catch(\Exception $e) {
			return $e->getMessage();
		}
	}

	public function loadItemData(int $id, RedisService $redisService, Redis $redis) {
		try{
            if($redisService->getService()->exists('/v1/item/' . $id) === 1){
                $data = $redis->getCache($redisService,'/v1/item/' . $id);
            }else {
                $data = $this->getSingleItemsRequest($id);
            }
            return new ArrayCollection(json_decode($data, TRUE));
		}catch(\Exception $e) {
			return $e->getMessage();
		}
	}

	private function getItemsRequest() {
		return $this->filmApiClient->send($this->filmApiClient->getRequest('items'), new HttpService)->getBody()->getContents()??
        throw new \Exception("Get items crashed!");
	}

    private function getSingleItemsRequest($id) {
        return $this->filmApiClient->send($this->filmApiClient->getRequest('items/' . $id), new HttpService)->getBody()->getContents()??
            throw new \Exception("Get items crashed!");
    }

    public function publicItemsRequest(){
        return $this->getItemsRequest();
    }
}
