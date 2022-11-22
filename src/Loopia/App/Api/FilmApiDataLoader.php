<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use Doctrine\Common\Collections\ArrayCollection;
use \Loopia\App\Api\Redis;

class FilmApiDataLoader extends Redis {

	public function __construct(protected Client $filmApiClient) {
		$this->filmApiClient = $filmApiClient;
	}

	public function loadData() {
		try{
			$data = $this->getCache('/v1/items');
			if(!$data)
				$data = $this->getItemsRequest(); 	
			return new ArrayCollection(json_decode($data, TRUE));
		}catch(\Exception $e) {
			return $e->getMessage();
		}
	}

	public function loadItemData(int $id) {
		try{
			$data = json_decode($this->getCache('/v1/item/' . $id), TRUE);
			return $data;
		}catch(\Exception $e) {
			return $e->getMessage();
		}
	}

	public function getItemsRequest() {
		return $this->filmApiClient->send($this->filmApiClient->getRequest('items'))->getBody()->getContents()??
        throw new \Exception("Get items crashed!");
	}
}
