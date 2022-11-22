<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Controllers;

use Loopia\App\Api\FilmApiDataLoader;

class FilmDetails extends BaseController {

	public function __construct(protected FilmApiDataLoader $loader) {
		$this->loader = $loader;
	}

	public function __invoke(int $id) {
		return $this->render('show.phtml', [
			'items' => $this->loader->loadItemData($id),
		]);
	}
}
