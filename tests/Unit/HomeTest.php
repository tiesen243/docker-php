<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Controllers\HomeController;
use Framework\Http\Response;

class HomeTest extends TestCase
{
  public function testIndexReturnsHomeView(): void
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
