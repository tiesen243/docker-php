<?php

namespace App\Controllers;

use Framework\Core\Controller;

class HomeController extends Controller
{
  public function index()
  {
    return $this->render('index', [
      'posts' => [
        ['title' => 'First Post', 'content' => 'This is the first post.'],
        ['title' => 'Second Post', 'content' => 'This is the second post.'],
      ],
    ]);
  }
}
