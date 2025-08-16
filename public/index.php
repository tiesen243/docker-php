<?php

use Framework\Application;
use Framework\Core\Template;

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

Template::create(
  BASE_PATH . '/resources/views',
  BASE_PATH . '/resources',
  sys_get_temp_dir() . '/.cache/views',
);

$app = new Application(BASE_PATH);
$app->run();
