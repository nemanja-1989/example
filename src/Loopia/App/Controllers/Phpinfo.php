<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Controllers;

class Phpinfo extends BaseController {

    /**
     * @return false|string
     * @throws \Loopia\App\Error\TemplatePathNotFoundException
     * @throws \Loopia\App\Error\TemplatePathNotReadableException
     */
	public function __invoke(): string|false {
		return $this->render('phpinfo.phtml', []);
	}
}
