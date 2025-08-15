<?php

use App\Controllers\HomeController;

return [
  // Home routes
  ['GET', '/', [HomeController::class, 'index']],
];
