<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use Doctrine\Common\Collections\ArrayCollection;
use \Loopia\App\Api\Redis;

class FilmApiDataLoader extends Redis {

	protected Client $filmApiClient;

	public function __construct(Client $filmApiClient) {
		$this->filmApiClient = $filmApiClient;
	}

	public function loadData() {
		/* @var $response ResponseInterface */
		$response = $this->filmApiClient->send($this->filmApiClient->getRequest('items'));
		$data =  $response->getBody()->getContents();
		$data = $this->setCache('/v1/items', $data);
		$data = $this->getCache('/v1/items');
		foreach(json_decode($data, TRUE) as $item) {
			$this->setCache('/v1/item/' . $item['id'], json_encode($item));
		}
		return new ArrayCollection(json_decode($data, TRUE));
	}

	public function loadItemData(int $id) {
		$data = $this->getCache('/v1/item/' . $id);
		$data = json_decode($data, true);
		return $data;
	}

}
