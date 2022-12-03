<?php

$loader = require_once __DIR__ . '/../vendor/autoload.php';

use Loopia\App\Api\FilmApiDataCache;
use Loopia\App\Api\FilmApiDataMemcache;
use Loopia\App\Api\Load;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Loopia\App\ServiceModels\Memcache;
use Loopia\App\ServiceModels\Redis;
use Loopia\App\Services\MemcacheService;
use Loopia\App\Services\RedisService;
use Loopia\App\Console\Schedule;
use Loopia\App\Containers\ContainerModel;
use Loopia\App\ServiceModels\Client;
use Loopia\App\Services\HttpService;

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

$containerBuilder->set('Load', new Load(new Client, new RedisService, new Redis, new HttpService, new MemcacheService, new Memcache));
$containerBuilder->set('FilmApiDataMemcache', new FilmApiDataMemcache(new Load(new Client, new RedisService, new Redis, new HttpService, new MemcacheService, new Memcache), new MemcacheService, new Memcache));
$containerBuilder->set('FilmApiDataCache', new FilmApiDataCache(new Load(new Client, new RedisService, new Redis, new HttpService, new MemcacheService, new Memcache), new RedisService, new Redis));
$containerBuilder->set('Schedule', new Schedule(new RedisService, new Redis, new MemcacheService, new Memcache));

$containerBuilder->compile(true);
return $containerBuilder;
