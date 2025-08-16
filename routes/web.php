<?php

use Framework\Core\Router;

use App\Controllers\HomeController;
use App\Controllers\PostController;

Router::get('/', [HomeController::class, 'index']);

Router::get('/posts', [PostController::class, 'index']);
Router::get('/posts/create', [PostController::class, 'create']);
Router::post('/posts/store', [PostController::class, 'store']);
Router::post('/posts/delete', [PostController::class, 'delete']);
Router::get('/posts/{id}', [PostController::class, 'show']);
Router::get('/posts/{id}/edit', [PostController::class, 'edit']);
