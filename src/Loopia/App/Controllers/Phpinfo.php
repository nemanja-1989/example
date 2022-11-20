<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Controllers;

class Phpinfo extends BaseController {

	public function __invoke() {
		return $this->render('phpinfo.phtml', []);
	}
}
