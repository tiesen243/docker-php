<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\controllers\HomeController;
use Framework\Http\Response;

class HomeTest extends TestCase
{
  public function testIndexReturnsHomeViewWithPosts(): void
  {
    $controller = new HomeController();
    $response = $controller->index();

    $this->assertInstanceOf(
      Response::class,
      $response,
      'Expected index() to return a Response',
    );
  }
}
