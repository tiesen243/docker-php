<?php

require_once __DIR__ . '/vendor/autoload.php';

class Seeder
{
  public static function run()
  {
    self::loadEnv();

    $pdo = new PDO(
      "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']};charset=utf8mb4",
      $_ENV['DB_USER'],
      $_ENV['DB_PASSWORD'],
    );

    $stmt = $pdo->prepare('
      CREATE TABLE IF NOT EXISTS post (
        `id` varchar(255) NOT NULL PRIMARY KEY,
        `title` varchar(255) NOT NULL,
        `content` text NOT NULL,
        `created_at` date NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
    ');
    if (!$stmt->execute()) {
      throw new Exception(
        'Failed to create table: ' . implode(', ', $stmt->errorInfo()),
      );
    }
  }

  private static function loadEnv()
  {
    $envFile = __DIR__ . '/.env';
    if (!file_exists($envFile)) {
      return;
    }

    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
      if (str_starts_with($line, '#')) {
        continue;
      }

      [$name, $value] = array_map('trim', explode('=', $line, 2));
      $value = trim($value, "'\"");

      $_ENV[$name] = $value;
    }
  }
}

Seeder::run();
