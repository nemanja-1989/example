<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Core;

use FastRoute\Dispatcher\GroupCountBased;
use FastRoute\RouteCollector;

class DispatcherFactory {

	protected $routeCollector;
	protected $routes;

	public function __construct(RouteCollector $routeCollector, array $routes) {
		$this->routeCollector = $routeCollector;
		$this->routes = $routes;
	}

	public function createRouteCollection(): array {
		foreach ($this->routes as $route) {
			$this->routeCollector->addRoute($route['method'], $route['path'], $route['controller']);
		}
		return $this->routeCollector->getData();
	}

	public function createDispatcher() {
		return new GroupCountBased($this->createRouteCollection());
	}

}
