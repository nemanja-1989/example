<?php

require_once dirname(__DIR__) . '/loopia/vendor/autoload.php';
$container = require_once dirname(__DIR__) . '/loopia/src/application.php';

$schedule = $container->get('Schedule');
$schedule->exe();