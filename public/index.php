<?php

use Framework\Core\Router;
use Framework\Core\Template;

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

Router::get('/', function () {
  $template = new Template();
  return $template->render('index');
});

echo Router::getRoutes()['GET']['/']();
