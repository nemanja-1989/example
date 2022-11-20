<?php

namespace Loopia\App\Controllers;

use Loopia\App\Error\TemplatePathNotFoundException;
use Loopia\App\Error\TemplatePathNotReadableException;
use Loopia\App\Template\Template;

abstract class BaseController {

	protected CONST TEMPLATE_PATH = __DIR__ . '/../../../../template';

	protected function renderBody(string $content) {
		$templatePath = self::TEMPLATE_PATH . DIRECTORY_SEPARATOR . '_body.phtml';
		return (new Template($templatePath, ['content' => $content]))->render();
	}

	protected function render(string $path, array $data = []) {
		$templatePath = self::TEMPLATE_PATH . DIRECTORY_SEPARATOR . $path;

		if (!is_file($templatePath)) {
			throw new TemplatePathNotFoundException($templatePath);
		}

		if (!\is_readable($templatePath)) {
			throw new TemplatePathNotReadableException($templatePath);
		}

		return $this->renderBody((new Template($templatePath, $data))->render());
	}

}
