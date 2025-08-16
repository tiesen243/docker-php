<?php

namespace App\Models;

use Framework\Core\Database;
use PDO;

class Post
{
  public function __construct(
    private ?string $id = null,
    private string $title = '',
    private string $content = '',
    private string $createdAt = '',
  ) {}

  public static function findMany(?string $page = '1'): array
  {
    $pdo = Database::getPdo();
    $stmt = $pdo->prepare(
      'SELECT * FROM post
      ORDER BY created_at DESC
      LIMIT 10
      OFFSET :offset',
    );
    $offset = ($page - 1) * 10;
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalPagesStmt = $pdo->query('SELECT COUNT(*) FROM post');
    $totalPosts = $totalPagesStmt->fetchColumn();
    $totalPages = ceil($totalPosts / 10);

    return [
      'page' => $page,
      'totalPages' => $totalPages,
      'posts' => array_map(function ($post) {
        return new Post(
          $post['id'],
          $post['title'],
          $post['content'],
          $post['created_at'],
        );
      }, $posts),
    ];
  }

  public static function findOne(string $id): ?Post
  {
    $pdo = Database::getPdo();
    $stmt = $pdo->prepare('SELECT * FROM post WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($post) {
      return new Post(
        $post['id'],
        $post['title'],
        $post['content'],
        $post['created_at'],
      );
    }

    return null;
  }

  public function save(): void
  {
    $pdo = Database::getPdo();
    $stmt = $pdo->prepare(
      'INSERT INTO post (id, title, content, created_at)
      VALUES (UUID(), :title, :content, NOW())',
    );

    if (!empty($this->id)) {
      $stmt = $pdo->prepare(
        'UPDATE post SET title = :title, content = :content WHERE id = :id',
      );
      $stmt->bindParam(':id', $this->id);
    }

    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':content', $this->content);
    if (!$stmt->execute()) {
      throw new \Exception(
        'Failed to save post: ' . implode(', ', $stmt->errorInfo()),
      );
    }

    $stmt = $pdo->prepare(
      'SELECT id FROM post WHERE title = :title AND content = :content',
    );
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':content', $this->content);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $this->id = $result['id'];
    } else {
      throw new \Exception('Failed to retrieve post ID after saving.');
    }
  }

  public function delete(): void
  {
    if (empty($this->id)) {
      throw new \Exception('Cannot delete a post without an ID.');
    }

    $pdo = Database::getPdo();
    $stmt = $pdo->prepare('DELETE FROM post WHERE id = :id');
    $stmt->bindParam(':id', $this->id);
    if (!$stmt->execute()) {
      throw new \Exception(
        'Failed to delete post: ' . implode(', ', $stmt->errorInfo()),
      );
    }
  }

  // Getters for the properties
  public function getId(): string
  {
    return $this->id;
  }

  public function getTitle(): string
  {
    return $this->title;
  }

  public function getContent(): string
  {
    return $this->content;
  }

  public function getProperties(): array
  {
    return [
      'id' => $this->id,
      'title' => $this->title,
      'content' => $this->content,
      'created_at' => $this->createdAt,
    ];
  }

  public function getCreatedAt(): string
  {
    return $this->createdAt;
  }

  // Setters for the properties
  public function setId(string $id): void
  {
    $this->id = $id;
  }

  public function setTitle(string $title): void
  {
    $this->title = $title;
  }

  public function setContent(string $content): void
  {
    $this->content = $content;
  }

  public function setCreatedAt(string $createdAt): void
  {
    $this->createdAt = $createdAt;
  }
}
