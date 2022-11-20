<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Template;

class Template {

	protected $templatePath;
	protected $vars;

	public function __construct(string $templatePath, array $vars = []) {
		$this->templatePath = $templatePath;
		$this->vars = $vars;
	}


	public function __get($name) {
		if (!array_key_exists($name, $this->vars)) {
			throw new \Exception('Template doesn\'t have variable: ' . $name);
		}

		return $this->vars[$name];
	}

	public function render() { //preimenuj funkciju, dodaj još nešto, za merge conlict
		ob_start();
		include $this->templatePath;
		return ob_get_clean();
	}


}
