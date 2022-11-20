<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Controllers;


class RedirectToVersion extends BaseController {

	public function __invoke() {
		\header('Location: /v1/');
	}
}
