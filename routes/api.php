<?php

use Framework\Core\Router;

Router::get('/api/posts', function () {
  header('Content-Type: application/json');

  return json_encode([
    [
      'id' => 1,
      'title' => 'First Post',
      'content' => 'This is the first post.',
    ],
    [
      'id' => 2,
      'title' => 'Second Post',
      'content' => 'This is the second post.',
    ],
  ]);
});
