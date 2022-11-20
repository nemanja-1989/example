<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Core;

use FastRoute\Dispatcher;
use Loopia\App\Error\MethodNotAllowedException;
use Loopia\App\Error\NotFoundException;
use Psr\Log\LoggerInterface;

abstract class HttpApplication extends Application {

	/**
	 *
	 * @var Dispatcher
	 */
	protected $dispatcher;

	public function __construct(Dispatcher $dispatcher, LoggerInterface $logger) {
		parent::__construct($logger);
		$this->dispatcher = $dispatcher;
	}

	public function run() {
		// Fetch method and URI from somewhere
		$httpMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
		$uriRaw = filter_input(INPUT_SERVER, 'REQUEST_URI');

		// Strip query string (?foo=bar) and decode URI
		if (false !== $pos = strpos($uriRaw, '?')) {
			$uri = substr($uriRaw, 0, $pos);
		}
		$uri = rawurldecode($uriRaw);

		$this->logger->debug('Current route', ['uri' => $uri]);
		$routeInfo = $this->dispatcher->dispatch($httpMethod, $uri);

		switch ($routeInfo[0]) {
			case Dispatcher::NOT_FOUND:
				$this->logger->info('Route not found', ['uri' => $uri]);
				throw new NotFoundException();
			case Dispatcher::METHOD_NOT_ALLOWED:
				$this->logger->info('Method not allowed', ['method' => $httpMethod, 'uri' => $uri]);
				throw new MethodNotAllowedException($httpMethod);
			case Dispatcher::FOUND:
				$this->logger->info('Route hit', ['method' => $httpMethod, 'uri' => $uri, 'routeInfo' => $routeInfo]);
				return call_user_func_array($routeInfo[1], $routeInfo[2]);
		}
	}

}
