<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Error;

class TemplatePathNotReadableException extends \Exception {

	public function __construct(string $path, string $message = "", int $code = 0, \Throwable $previous = null) {
		parent::__construct('Template path not readable: ' . $path . '; ' .$message, $code, $previous);
	}
}
