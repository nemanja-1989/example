<?php

require_once dirname(__DIR__) . '/example/vendor/autoload.php';
use Loopia\App\Containers\ContainerModel;

$container = new ContainerModel();
$schedule = $container->build()->get('Schedule');
$schedule->exe();