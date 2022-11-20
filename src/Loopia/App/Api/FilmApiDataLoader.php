<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use Doctrine\Common\Collections\ArrayCollection;
use Psr\Http\Message\ResponseInterface;

class FilmApiDataLoader {

	protected Client $filmApiClient;

	public function __construct(Client $filmApiClient) {
		$this->filmApiClient = $filmApiClient;
	}

	public function loadData() {
		/* @var $response ResponseInterface */
		$response = $this->filmApiClient->send($this->filmApiClient->getRequest('items'));
		$data =  \json_decode($response->getBody()->getContents(), true);
		return new ArrayCollection($data);
	}

	public function loadItemData(int $id) {
		$response = $this->filmApiClient->send($this->filmApiClient->getRequest('items'));
		$data =  \json_decode($response->getBody()->getContents(), true);
		return new ArrayCollection($data);
	}

}
