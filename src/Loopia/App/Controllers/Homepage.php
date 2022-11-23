<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Controllers;

use Loopia\App\Api\FilmApiDataLoader;

class Homepage extends BaseController {

	public function __construct(protected FilmApiDataLoader $loader) {
		$this->loader = $loader;
	}

	public function __invoke() {
		return $this->render('index.phtml', [
			'items' => $this->loader->loadData(),
		]);
	}
}
