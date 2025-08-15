<?php

namespace Framework\Core;

class Router
{
  private static array $routes = [];

  public static function get(string $path, callable $callback): void
  {
    self::$routes['GET'][$path] = $callback;
  }

  public static function post(string $path, callable $callback): void
  {
    self::$routes['POST'][$path] = $callback;
  }

  public static function getRoutes(): array
  {
    return self::$routes;
  }
}
