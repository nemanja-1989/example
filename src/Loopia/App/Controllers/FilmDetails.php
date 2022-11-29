<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Controllers;

use Loopia\App\Api\FilmApiDataLoader;

class FilmDetails extends BaseController {

    /**
     * @param FilmApiDataLoader $loader
     */
	public function __construct(protected FilmApiDataLoader $loader) {
		$this->loader = $loader;
	}

    /**
     * @param int $id
     * @return false|string
     * @throws \Loopia\App\Error\TemplatePathNotFoundException
     * @throws \Loopia\App\Error\TemplatePathNotReadableException
     */
	public function __invoke(int $id) {
		return $this->render('show.phtml', [
			'items' => $this->loader->getById(id: $id),
		]);
	}
}
