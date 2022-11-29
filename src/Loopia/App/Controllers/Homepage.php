<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Controllers;

use Loopia\App\Api\FilmApiDataLoader;

class Homepage extends BaseController {

    /**
     * @param FilmApiDataLoader $loader
     */
	public function __construct(protected FilmApiDataLoader $loader) {
		$this->loader = $loader;
	}

    /**
     * @return false|string
     * @throws \Loopia\App\Error\TemplatePathNotFoundException
     * @throws \Loopia\App\Error\TemplatePathNotReadableException
     */
	public function __invoke() {
		return $this->render('index.phtml', [
			'items' => $this->loader->getResponse(),
		]);
	}
}
