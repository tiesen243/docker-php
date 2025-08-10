<?php

namespace Yuki\Http;

use FastRoute\RouteCollector;
use Yuki\Http\Request;
use Yuki\Http\Response;

use function FastRoute\simpleDispatcher;

class Kernel
{
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
        return call_user_func_array([new $controller(), $method], $vars);
      default:
        return new Response('Not Found', 404, ['Content-Type' => 'text/plain']);
    }
  }
}
