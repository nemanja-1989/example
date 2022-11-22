<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use Doctrine\Common\Collections\ArrayCollection;
use \Loopia\App\Api\Redis;

class FilmApiDataLoader extends Redis {

	public Client $filmApiClient;

	public function __construct(Client $filmApiClient) {
		$this->filmApiClient = $filmApiClient;
	}

	public function loadData() {
		/* @var $response ResponseInterface */
		$data = $this->getCache('/v1/items');
		if(!$data){
			$data = $this->getItemsRequest();
		} 	
		return new ArrayCollection(json_decode($data, TRUE));
	}

	public function loadItemData(int $id) {
		$data = $this->getCache('/v1/item/' . $id);
		$data = json_decode($data, true);
		return $data;
	}

	public function getItemsRequest() {
		return $this->filmApiClient->send($this->filmApiClient->getRequest('items'))->getBody()->getContents();
	}
}
