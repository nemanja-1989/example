<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\ServiceModels;

use GuzzleHttp\Psr7\Request;
use Loopia\App\Services\HttpService;

class Client
{
    /**
     * @param string $uri
     * @return Request
     */
    public function getRequest(string $uri, string $username, string $password): Request
    {
        return new Request('GET', $uri, [
            'X-Authorization' => 'Bearer ' . $username . ":" . \base64_encode($password),
            'Accept' => 'application/json'
        ]);
    }

    /**
     * @param Request $request
     * @param HttpService $httpService
     * @return \GuzzleHttp\Psr7\Response|\ErrorException
     */
    public function send(Request $request, HttpService $httpService, $uri): \GuzzleHttp\Psr7\Response|\ErrorException
    {
        return $this->getResponse($request, $httpService, $uri);
    }

    /**
     * @param Request $request
     * @param HttpService $httpService
     * @return \GuzzleHttp\Psr7\Response|\ErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getResponse(Request $request, HttpService $httpService, $uri): \GuzzleHttp\Psr7\Response|\ErrorException
    {
        return $httpService->getService($uri)->send($request);
    }
}
