<?php 

require_once dirname(__DIR__) . '/loopia/vendor/autoload.php';

use Loopia\App\Api\Client;
use Loopia\App\Api\FilmApiDataCache;
use Loopia\App\Console\Schedule;
use Loopia\App\Api\FilmApiDataLoader;

$schedule = new Schedule();
$schedule->exe();