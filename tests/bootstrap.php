<?php

use Framework\Core\Template;

define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/vendor/autoload.php';

Template::create(
  BASE_PATH . '/resources/views',
  BASE_PATH . '/resources',
  BASE_PATH . '/.cache/views',
);
