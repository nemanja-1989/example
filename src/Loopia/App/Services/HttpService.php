<?php 

namespace Loopia\App\Services;

use GuzzleHttp\Client;
use Loopia\App\Constants\Constants;
use Loopia\App\Interface\ServiceInterface;

class HttpService implements ServiceInterface {

    public function getService(string $url = null)
    {
        return new Client(['base_uri' => $url, 'timeout' => 0, 'allow_redirects' => false]);
    }
    
}