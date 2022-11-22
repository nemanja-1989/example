<?php 

require_once dirname(__DIR__) . '/loopia/vendor/autoload.php';

use Loopia\App\Api\Client;
use Loopia\App\Api\FilmApiDataCache;
use Loopia\App\Console\Schedule;
use Loopia\App\Api\FilmApiDataLoader;

/**
 * service dependencies
 */
$client = new Client;
/**
 * classes dependencies
 */

 //ITEMS
$loader = new FilmApiDataLoader($client);
$prepareCacheItems = new FilmApiDataCache($loader);

/**
 * crontab
 */
$schedule = new Schedule($prepareCacheItems);
$schedule->run();