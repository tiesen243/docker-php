<?php

namespace App\Controllers;

use Yuki\Core\Controller;

class HomeController extends Controller
{
  public function index()
  {
    return $this->render('page');
  }
}
