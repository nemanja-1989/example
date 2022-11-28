<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use GuzzleHttp\Psr7\Request;
use Loopia\App\Services\HttpService;
use Loopia\App\Constants\Constants;

class Client
{
    public function getRequest(string $uri): Request
    {
        return new Request('GET', $uri, [
            'X-Authorization' => 'Bearer ' . Constants::MOVIE_API_USERNAME . ":" . base64_encode(Constants::MOVIE_API_PASSWORD),
            'Accept' => 'application/json'
        ]);
    }

    public function send(Request $request, HttpService $httpService) : \GuzzleHttp\Psr7\Response|\ErrorException
    {
        return $this->getResponse($request, $httpService);
    }

    private function getResponse(Request $request, HttpService $httpService): \GuzzleHttp\Psr7\Response|\ErrorException
    {
          return $httpService->getService(Constants::MOVIE_URI . 'items')->send($request);
    }
}
