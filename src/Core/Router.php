<?php

namespace Framework\Core;

use Framework\Http\Request;
use Framework\Http\Response;

class Router
{
  private static array $routes = [];

  public static function get(string $path, $callback): void
  {
    self::$routes['GET'][] = [
      'path' => $path,
      'callback' => $callback,
    ];
  }

  public static function post(string $path, $callback): void
  {
    self::$routes['POST'][] = [
      'path' => $path,
      'callback' => $callback,
    ];
  }

  public static function handler(Request $request)
  {
    $method = $request->getServerInfo()['method'] ?? 'GET';
    $uri = $request->getServerInfo()['uri'] ?? '/';
    $routes = self::$routes[$method] ?? [];

    foreach ($routes as $route) {
      $pattern = preg_replace('#\{([^}]+)\}#', '([^/]+)', $route['path']);
      $pattern = '#^' . $pattern . "$#";

      if (preg_match($pattern, $uri, $matches)) {
        array_shift($matches);

        if (is_array($route['callback']) && count($route['callback']) === 2) {
          [$controller, $method] = $route['callback'];
          $controller = new $controller();
          $controller->setRequest($request);
          return call_user_func_array([$controller, $method], $matches);
        } elseif (is_callable($route['callback'])) {
          return call_user_func_array($route['callback'], $matches);
        }
      }
    }

    $templateEngine = Template::getInstance();
    return new Response($templateEngine->render('_error'));
  }
}
