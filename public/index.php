<?php

use Framework\Application;

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

$app = new Application(BASE_PATH);
$app->run();
