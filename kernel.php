<?php

require_once dirname(__DIR__) . '/loopia/vendor/autoload.php';
// $container = require_once dirname(__DIR__) . '/loopia/src/application.php';
use Loopia\App\Containers\ContainerModel;

$container = new ContainerModel();
$schedule = $container->build()->get('Schedule');
$schedule->exe();