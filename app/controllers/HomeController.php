<?php

namespace App\controllers;

use Yuki\Core\Controller;
use Yuki\Core\Database;

class HomeController extends Controller
{
  public function index()
  {
    $query = 'SELECT * FROM post ORDER BY created_at DESC';
    $db = Database::getInstance();
    $stmt = $db->prepare($query);
    $stmt->execute();
    $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $this->render('home', ['posts' => $posts]);
  }
}
