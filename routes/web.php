<?php

use Framework\Core\Router;

use App\Controllers\HomeController;

Router::get('/', [HomeController::class, 'index']);
Router::get('/posts/{id}', function ($id) {
  return "Post ID: $id";
});
