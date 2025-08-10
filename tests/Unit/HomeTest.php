<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\controllers\HomeController;
use Yuki\Http\Response;

class HomeTest extends TestCase
{
  public function testIndexReturnsHomeViewWithPosts(): void
  {
    $mockDb = $this->createMock(\PDO::class);
    $mockStmt = $this->createMock(\PDOStatement::class);
    $mockPosts = [
      ['id' => 1, 'title' => 'Test Post', 'created_at' => '2025-08-11'],
      ['id' => 2, 'title' => 'Another Post', 'created_at' => '2025-08-10'],
    ];

    $mockDb->method('prepare')->willReturn($mockStmt);
    $mockStmt->method('execute')->willReturn(true);
    $mockStmt->method('fetchAll')->willReturn($mockPosts);

    $controller = new HomeController($mockDb);
    $response = $controller->index();

    $this->assertInstanceOf(
      Response::class,
      $response,
      'Expected index() to return a Response',
    );

    $content = $response->getContent();
    foreach ($mockPosts as $post) {
      $this->assertStringContainsString($post['title'], $content);
    }
  }
}
