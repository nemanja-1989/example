<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Error;

class TemplatePathNotFoundException extends \Exception {

	public function __construct(string $path, string $message = "", int $code = 0, \Throwable $previous = null) {
		parent::__construct('Template path not found: ' . $path . '; ' .$message, $code, $previous);
	}
}
