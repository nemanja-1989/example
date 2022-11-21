<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Controllers;

use Loopia\App\Api\FilmApiDataLoader;

class FilmDetails extends BaseController {

	protected FilmApiDataLoader $loader;

	public function __construct(FilmApiDataLoader $loader) {
		$this->loader = $loader;
	}

	public function __invoke(int $id) {
		return $this->render('index.phtml', [
			'items' => $this->loader->loadItemData($id),
		]);
	}
}
