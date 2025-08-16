<?php

use App\Controllers\PostController;
use Framework\Core\Router;

Router::get('/api/posts', [PostController::class, 'all']);
Router::get('/api/posts/{id}', [PostController::class, 'byId']);
