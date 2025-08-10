<?php

namespace Yuki\Http;

use FastRoute\RouteCollector;
use Yuki\Core\Controller;
use Yuki\Core\Database;
use Yuki\Http\Request;
use Yuki\Http\Response;

use function FastRoute\simpleDispatcher;

class Kernel
{
  protected ?Database $db = null;

  public function __construct()
  {
    $this->db = Database::create(
      "mysql:host=db;dbname={$_ENV['DB_NAME']};charset=utf8mb4",
      $_ENV['DB_USER'],
      $_ENV['DB_PASSWORD'],
    );
  }

  public function handle(Request $request): Response
  {
    $dispatcher = simpleDispatcher(function (RouteCollector $r) {
      $routes = include BASE_PATH . '/routes/web.php';
      foreach ($routes as $route) {
        $r->addRoute(...$route);
      }
    });

    $routeInfo = $dispatcher->dispatch(
      $request->getServerInfo()['method'],
      $request->getServerInfo()['uri'],
    );

    switch ($routeInfo[0]) {
      case \FastRoute\Dispatcher::FOUND:
        [, [$controller, $method], $vars] = $routeInfo;
        $controller = new $controller();
        if ($controller instanceof Controller) {
          $controller->setRequest($request);
        }
        return call_user_func_array([$controller, $method], $vars);
      default:
        return new Response('Not Found', 404, ['Content-Type' => 'text/plain']);
    }
  }
}
