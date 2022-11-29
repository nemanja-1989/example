<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Core;

use Psr\Log\LoggerInterface;

abstract class Application {

    /**
     * @param LoggerInterface $logger
     */
	public function __construct(protected LoggerInterface $logger) {
		$this->logger = $logger;
	}

}
