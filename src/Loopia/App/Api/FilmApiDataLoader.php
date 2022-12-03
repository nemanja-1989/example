<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use Doctrine\Common\Collections\ArrayCollection;
use Loopia\App\Interface\ResponseInterface;
use Loopia\App\Interface\ResponseSingleInterface;

class FilmApiDataLoader implements ResponseInterface, ResponseSingleInterface
{

    public function __construct() {
        $this->container = require_once dirname(__DIR__) . '/../../application.php';
    }

    /**
     * @return Load
     */
    private function getLoadClass(): Load
    {
        return $this->container->get('Load');
    }

    /**
     * @return ArrayCollection|string
     */
    public function getResponse(): ArrayCollection|string
    {
        return $this->getLoadClass()->loadData();
    }

    /**
     * @param $id
     * @return ArrayCollection|string
     */
    public function getById($id): ArrayCollection|string
    {
        return $this->getLoadClass()->loadItemData($id);
    }
}
