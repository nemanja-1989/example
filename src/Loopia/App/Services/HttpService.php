<?php 

namespace Loopia\App\Services;

use GuzzleHttp\Client;
use Loopia\App\Interface\ServiceInterface;

class HttpService implements ServiceInterface {

    /**
     * @param string|null $url
     * @return Client
     */
    public function getService(string $url = null) :Client
    {
        return new Client(['base_uri' => $url, 'timeout' => 0, 'allow_redirects' => false]);
    }
    
}