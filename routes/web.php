<?php

use Framework\Core\Router;

use App\Controllers\HomeController;
use App\Controllers\PostController;

Router::get('/', [HomeController::class, 'index']);

Router::get('/posts', [PostController::class, 'index']);
