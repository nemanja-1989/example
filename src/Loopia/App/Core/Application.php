<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Core;

use Psr\Log\LoggerInterface;

abstract class Application {

	protected $logger;

	public function __construct(LoggerInterface $logger) {
		$this->logger = $logger;
	}

}
