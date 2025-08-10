<?php

namespace App\controllers;

use Yuki\Core\Controller;

class HomeController extends Controller
{
  public function index()
  {
    return $this->render('home');
  }
}
