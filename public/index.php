<?php

/* @var $container \Symfony\Component\DependencyInjection\Container */
$container = require_once __DIR__ . '/../src/application.php';

/* @var $filmApi \Loopia\App\Core\FilmApiHttpApplication */
$filmApi = $container->get('application');
$filmApi->run();