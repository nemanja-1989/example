<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use http\Env\Response;
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

    public function send(Request $request, HttpService $httpService): \GuzzleHttp\Psr7\Response|\ErrorException
    {
        return $httpService->getService('http://filmapi.loopiarnd.com/items')->send($request) ?? throw new \ErrorException;
    }
}
