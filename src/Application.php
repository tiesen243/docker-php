<?php

namespace Framework;

use Framework\Core\Router;
use Framework\Http\Request;
use Framework\Http\Response;

class Application
{
  public function __construct()
  {
    require_once BASE_PATH . '/routes/api.php';
    require_once BASE_PATH . '/routes/web.php';
  }

  public function run(Request $request)
  {
    $result = Router::handler($request);
    if ($result instanceof Response) {
      $result->send();
    } else {
      echo $result;
    }
  }
}
