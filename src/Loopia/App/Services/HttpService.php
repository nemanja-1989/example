<?php 

namespace Loopia\App\Services;

use GuzzleHttp\Client;
use Loopia\App\Constants\Constants;
use Loopia\App\Interface\ServiceInterface;

class HttpService implements ServiceInterface {

    public function getService()
    {
        return new Client(['base_uri' => Constants::MOVIE_URI, 'timeout' => 0, 'allow_redirects' => false]);
    }
    
}