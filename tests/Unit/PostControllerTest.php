<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\PostController;
use App\Models\Post;

class PostControllerTest extends TestCase
{
  private $requestMock;

  protected function setUp(): void
  {
    $this->requestMock = $this->createMock(\Framework\Http\Request::class);
  }

  public function testAllReturnsJsonResponse()
  {
    $this->requestMock
      ->method('query')
      ->willReturn(['page' => '1', 'limit' => '2']);

    $mockPostModel = $this->createMock(Post::class);
    $mockPostModel->method('findMany')->willReturn([
      'page' => 1,
      'totalPages' => 1,
      'posts' => [],
    ]);

    $controller = new PostController($mockPostModel);
    $controller->setRequest($this->requestMock);

    $response = $controller->all();
    $this->assertInstanceOf(\Framework\Http\Response::class, $response);
    $this->assertEquals(200, $response->getStatusCode());
  }

  public function testByIdReturnsJsonResponse()
  {
    $postId = '123';
    $this->requestMock->method('query')->willReturn(['id' => $postId]);
    $mockPostModel = $this->createMock(Post::class);
    $mockPostModel
      ->method('findOne')
      ->with($postId)
      ->willReturn(
        new Post($postId, 'Test Title', 'Test Content', '2023-10-01 12:00:00'),
      );

    $controller = new PostController($mockPostModel);
    $controller->setRequest($this->requestMock);

    $response = $controller->byId($postId);
    $this->assertInstanceOf(\Framework\Http\Response::class, $response);
    $this->assertEquals(200, $response->getStatusCode());
    $this->assertJsonStringEqualsJsonString(
      json_encode([
        'id' => $postId,
        'title' => 'Test Title',
        'content' => 'Test Content',
        'created_at' => '2023-10-01 12:00:00',
      ]),
      $response->getBody(),
    );
  }
}
