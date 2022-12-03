<?php

$loader = require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$containerBuilder = new ContainerBuilder();
$env = 'prod';
$rootDir = __DIR__.'/..';
$loader = new YamlFileLoader($containerBuilder, new FileLocator([
	$rootDir.'/config/',
	$rootDir.'/config/defaults/',
	$rootDir.'/config/'.$env.'/',
]));
$loader->load('services.yaml');
$loader->load('http_services.yaml');
$loader->load('film_api_services.yaml');
$loader->load('routes.yaml');

$containerBuilder->compile(true);
return $containerBuilder;
