<?php

namespace Framework\Core;

use PDO;

class Database
{
  private static $instance = null;
  public ?PDO $pdo = null;

  /**
   * Private constructor to prevent direct instantiation. Use the create method
   * to get an instance.
   *
   * @param string $connectionString The DSN for the database connection.
   * @param string $username The username for the database connection.
   * @param string $password The password for the database connection.
   */
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

  /**
   * Get the singleton instance of the Database class.
   *
   * @param string $connectionString The DSN for the database connection.
   * @param string $username The username for the database connection.
   * @param string $password The password for the database connection.
   *
   * @return static The singleton instance of the Database class.
   */
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

  /**
   * Returns the active PDO database connection from the singleton Database instance.
   *
   * @return PDO The active PDO connection.
   * @throws \Exception If the database connection has not been initialized.
   */
  public static function getPdo(): PDO
  {
    return self::$instance->pdo ??
      throw new \Exception('Database connection not initialized');
  }
}
