<?php

declare(strict_types=1);

namespace Framework;

use Framework\Core\Database;
use Framework\Core\Router;
use Framework\Http\Request;
use Framework\Http\Response;

class Application
{
  public function __construct(string $basePath)
  {
    $this->loadEnv($basePath . '/.env');

    require_once $basePath . '/routes/api.php';
    require_once $basePath . '/routes/web.php';

    Database::create(
      "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8mb4",
      $_ENV['DB_USER'],
      $_ENV['DB_PASSWORD'],
    );
  }

  public function run(): void
  {
    $request = Request::create();

    $result = Router::handler($request);
    if ($result instanceof Response) {
      $result->send();
    } else {
      echo $result;
    }
  }

  private function loadEnv(string $path): void
  {
    if (!file_exists($path)) {
      return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
      if (str_starts_with($line, '#')) {
        continue;
      }

      [$name, $value] = array_map('trim', explode('=', $line, 2));
      $value = trim($value, "'\"");

      $_ENV[$name] = $value;
      putenv("$name=$value");
    }
  }
}
