<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use Doctrine\Common\Collections\ArrayCollection;
use Psr\Http\Message\ResponseInterface;
use \Loopia\App\Services\RedisService;

class FilmApiDataLoader {

	protected Client $filmApiClient;
	protected RedisService $redisService;

	public function __construct(Client $filmApiClient) {
		$this->filmApiClient = $filmApiClient;
		$this->redisService = new RedisService;
	}

	public function loadData() {
		/* @var $response ResponseInterface */
		$response = $this->filmApiClient->send($this->filmApiClient->getRequest('items'));
		$data =  $response->getBody()->getContents();
		$data = $this->redisService->getService()->set('/v1/items', $data);
		$data = $this->redisService->getService()->get('/v1/items');
		foreach(json_decode($data, TRUE) as $item) {
			$this->redisService->getService()->set('/v1/item/' . $item['id'], json_encode($item));
		}
		return new ArrayCollection(json_decode($data, TRUE));
	}

	public function loadItemData(int $id) {
		$data = $this->redisService->getService()->get('/v1/item/' . $id);
		$data = json_decode($data, true);
		return $data;
	}

}
