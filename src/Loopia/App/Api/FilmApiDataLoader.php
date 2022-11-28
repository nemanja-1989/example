<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use Doctrine\Common\Collections\ArrayCollection;
use Loopia\App\Interface\ResponseInterface;
use Loopia\App\Interface\ResponseSingleInterface;
use Loopia\App\Services\HttpService;
use Loopia\App\Services\RedisService;


class FilmApiDataLoader implements ResponseInterface, ResponseSingleInterface
{

    private function getLoadClass() :Load
    {
        return new Load(new Client, new RedisService, new Redis, new HttpService);
    }

    public function getResponse() :ArrayCollection|string
    {
        return $this->getLoadClass()->loadData();
    }

    public function getById($id) :ArrayCollection|string
    {
        return $this->getLoadClass()->loadItemData($id);
    }
}
