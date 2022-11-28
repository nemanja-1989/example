<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use GuzzleHttp\Psr7\Request;
use Loopia\App\Services\HttpService;
use Loopia\App\Constants\Constants;

class Client {

	public function getRequest(string $uri): Request {
			return new Request('GET', $uri, [
				'X-Authorization' => 'Bearer ' . Constants::MOVIE_API_USERNAME . ":" . base64_encode(Constants::MOVIE_API_PASSWORD),
				'Accept'          => 'application/json'
			])?? throw new \Exception('Client broken!');
	}

	public function send(Request $request, HttpService $httpService) {
		try{
			return $httpService->getService()->send($request);
		}catch(\Exception $e) {
			return $e->getMessage();
		}
	}
}
