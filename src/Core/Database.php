<?php

namespace Framework\Core;

use PDO;

class Database
{
  private static $instance = null;
  public ?PDO $pdo = null;

  public function __construct(
    string $connectionString,
    string $username,
    string $password,
  ) {
    $this->pdo = new PDO($connectionString, $username, $password);

    if (!$this->pdo) {
      throw new \Exception('Failed to connect to the database');
    }
  }

  public static function create(
    string $connectionString,
    string $username,
    string $password,
  ): static {
    if (self::$instance === null) {
      self::$instance = new static($connectionString, $username, $password);
    }
    return self::$instance;
  }

  public function seed(): void
  {
    $pdo = self::getPdo();

    $stmt = $pdo->prepare('
      CREATE TABLE IF NOT EXISTS post (
        `id` varchar(255) NOT NULL PRIMARY KEY,
        `title` varchar(255) NOT NULL,
        `content` text NOT NULL,
        `created_at` date NOT NULL
      )');
    if (!$stmt->execute()) {
      throw new \Exception(
        'Failed to create table: ' . implode(', ', $stmt->errorInfo()),
      );
    }
  }

  public static function getPdo(): PDO
  {
    return self::$instance->pdo ??
      throw new \Exception('Database connection not initialized');
  }
}
