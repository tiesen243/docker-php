<?php

namespace App\models;

use PDO;

use Framework\Core\Database;

class Post
{
  public string $id;
  public string $title;
  public string $content;
  public string $created_at;

  public function __construct(?array $data = null)
  {
    foreach ($data ?? [] as $key => $value) {
      if (property_exists($this, $key)) {
        $this->$key = $value;
      }
    }
  }

  public static function findMany(): array
  {
    $pdo = Database::getPdo();
    $stmt = $pdo->query('SELECT * FROM post');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function findOne(string $id): ?array
  {
    $pdo = Database::getPdo();
    $stmt = $pdo->prepare('SELECT * FROM post WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
  }

  public function save(): bool
  {
    $pdo = Database::getPdo();
    print_r($this->id);

    if (!empty($this->id)) {
      $stmt = $pdo->prepare(
        'UPDATE post SET title = :title, content = :content WHERE id = :id',
      );
      return $stmt->execute([
        'id' => $this->id,
        'title' => $this->title,
        'content' => $this->content,
      ]);
    } else {
      $stmt = $pdo->prepare(
        'INSERT INTO post (id, title, content, created_at) VALUES (UUID(), :title, :content, NOW())',
      );
      $success = $stmt->execute([
        'title' => $this->title,
        'content' => $this->content,
      ]);
      if ($success) {
        $this->id = $pdo->lastInsertId();
      }
      return $success;
    }
  }

  public function delete(): bool
  {
    $pdo = Database::getPdo();
    if (empty($this->id)) {
      return false;
    }
    $stmt = $pdo->prepare('DELETE FROM post WHERE id = :id');
    return $stmt->execute(['id' => $this->id]);
  }
}
