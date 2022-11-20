<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Error;

class MethodNotAllowedException extends \Exception {

	public function __construct(string $method, string $message = "", int $code = 0, \Throwable $previous = null) {
		parent::__construct('Method not allowed: ' . $method . '; ' .$message, $code, $previous);
	}
}
