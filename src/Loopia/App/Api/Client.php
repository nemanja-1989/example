<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use GuzzleHttp\Psr7\Request;
use Loopia\App\Services\HttpService;
use Loopia\App\Constants\Constants;

class Client extends HttpService {

	public function getRequest(string $uri): Request {
		try{
			return new Request('GET', $uri, [
				'X-Authorization' => 'Bearer ' . Constants::MOVIE_API_USERNAME . ":" . base64_encode(Constants::MOVIE_API_PASSWORD),
				'Accept'          => 'application/json'
			]);
		}catch(\Exception $e) {
			return $e->getMessage();
		}	
	}

	public function send(Request $request) {
		try{
			return $this->getService()->send($request);
		}catch(\Exception $e) {
			return $e->getMessage();
		}
	}
}
