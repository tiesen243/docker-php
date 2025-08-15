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

  public static function getPdo(): PDO
  {
    return self::$instance->pdo ??
      throw new \Exception('Database connection not initialized');
  }
}
