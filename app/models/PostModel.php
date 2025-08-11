<?php

namespace App\models;

use PDO;

use Framework\Core\Database;

class PostModel
{
  public function all(): array
  {
    $db = Database::getInstance();
    $stmt = $db->prepare('SELECT * FROM post ORDER BY created_at DESC');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function byId(string $id): ?array
  {
    $db = Database::getInstance();
    $stmt = $db->prepare('SELECT * FROM post WHERE id = :id');
    $stmt->bindParam(':id', $id, \PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
  }

  public function create(array $data): ?string
  {
    $db = Database::getInstance();
    $stmt = $db->prepare(
      'INSERT INTO post (id, title, content, created_at) VALUES (UUID(), :title, :content, NOW())',
    );
    $stmt->bindParam(':title', $data['title'], \PDO::PARAM_STR);
    $stmt->bindParam(':content', $data['content'], \PDO::PARAM_STR);

    if ($stmt->execute()) {
      $stmt = $db->prepare(
        'SELECT id FROM post WHERE title = :title AND content = :content ORDER BY created_at DESC LIMIT 1',
      );
      $stmt->bindParam(':title', $data['title'], \PDO::PARAM_STR);
      $stmt->bindParam(':content', $data['content'], \PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result['id'] ?? null;
    }

    return null;
  }

  public function update(string $id, array $data): bool
  {
    $db = Database::getInstance();
    $stmt = $db->prepare(
      'UPDATE post SET title = :title, content = :content WHERE id = :id',
    );
    $stmt->bindParam(':id', $id, \PDO::PARAM_STR);
    $stmt->bindParam(':title', $data['title'], \PDO::PARAM_STR);
    $stmt->bindParam(':content', $data['content'], \PDO::PARAM_STR);
    return $stmt->execute();
  }

  public function delete(string $id): bool
  {
    $db = Database::getInstance();
    $stmt = $db->prepare('DELETE FROM post WHERE id = :id');
    $stmt->bindParam(':id', $id, \PDO::PARAM_STR);
    return $stmt->execute();
  }
}
