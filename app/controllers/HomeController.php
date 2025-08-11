<?php

namespace App\controllers;

use Framework\Core\Controller;

class HomeController extends Controller
{
  public function index()
  {
    return $this->render('index');
  }
}
