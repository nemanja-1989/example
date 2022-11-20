<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use Closure;
use Exception;
use GuzzleHttp\Psr7\Request;
use Loopia\App\Interface\CredentialsConsumerInterface;
use Loopia\App\Services\HttpService;
use Loopia\App\Constants\Constants;

class Client {

	protected Credentials $credentials;

	protected string $endpoint;

	protected HttpService $client;

	public function __construct(Credentials $credentials, string $endpoint) {
		$this->client = new HttpService;
	}

	public function getRequest(string $uri): Request {
		return new Request('GET', $uri, [
			'X-Authorization' => 'Bearer ' . Constants::MOVIE_API_USERNAME . ":" . base64_encode(Constants::MOVIE_API_PASSWORD),
			'Accept'          => 'application/json'
		]);
	}

	public function send(Request $request) {
		return $this->client->getService()->send($request);
	}
}
