<?php

use App\Controllers\HomeController;
use App\Controllers\PostController;

return [
  // Home routes
  ['GET', '/', [HomeController::class, 'index']],

  // Post routes
  ['GET', '/posts', [PostController::class, 'index']],
  ['GET', '/posts/all', [PostController::class, 'all']],
  ['GET', '/posts/create', [PostController::class, 'create']],
  ['GET', '/posts/{id}', [PostController::class, 'show']],
  ['GET', '/posts/{id}/edit', [PostController::class, 'edit']],
  ['POST', '/posts', [PostController::class, 'store']],
  ['POST', '/posts/{id}/delete', [PostController::class, 'delete']],
];
