<?php

declare(strict_types=1);

namespace Framework;

use Framework\Core\Database;
use Framework\Core\Router;
use Framework\Http\Request;
use Framework\Http\Response;

class Application
{
  public function __construct()
  {
    require_once BASE_PATH . '/routes/api.php';
    require_once BASE_PATH . '/routes/web.php';

    Database::create(
      "mysql:host=db;dbname={$_ENV['DB_NAME']};charset=utf8mb4",
      $_ENV['DB_USER'],
      $_ENV['DB_PASSWORD'],
    );
  }

  public function run(Request $request): void
  {
    $result = Router::handler($request);
    if ($result instanceof Response) {
      $result->send();
    } else {
      echo $result;
    }
  }
}
