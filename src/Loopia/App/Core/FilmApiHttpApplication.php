<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Core;

class FilmApiHttpApplication extends HttpApplication {

    /**
     * @return mixed|void
     * @throws \Loopia\App\Error\MethodNotAllowedException
     * @throws \Loopia\App\Error\NotFoundException
     */
	public function run() {
		$content = parent::run();
		\header('Content-Encoding: utf-8');
		\header('X-Data: films');
		\header('Content-Length: '.\strlen($content));
		\header('Cache-Control: max-age=3600, must-revalidate');
		\header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 3600));

		echo $content;
	}
}
