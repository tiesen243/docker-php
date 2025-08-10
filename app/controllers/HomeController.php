<?php

namespace App\controllers;

use PDO;
use Yuki\Core\Controller;
use Yuki\Core\Database;

class HomeController extends Controller
{
  protected PDO $db;

  public function __construct($db = null)
  {
    if ($db === null) {
      $db = Database::getInstance();
    }
    $this->db = $db;
  }

  public function index()
  {
    $query = 'SELECT * FROM post ORDER BY created_at DESC';
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $this->render('home', ['posts' => $posts]);
  }
}
