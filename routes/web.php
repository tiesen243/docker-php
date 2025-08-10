<?php

use App\controllers\HomeController;
use App\controllers\PostController;

return [
  ['GET', '/', [HomeController::class, 'index']],

  ['GET', '/posts/new', [PostController::class, 'create']],
  ['POST', '/posts/create', [PostController::class, 'store']],
  ['GET', '/posts/{id}', [PostController::class, 'show']],
  ['POST', '/posts/{id}/delete', [PostController::class, 'delete']],
];
