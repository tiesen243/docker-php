<?php

namespace Yuki\Core;

use Yuki\Http\Request;
use Yuki\Http\Response;

abstract class Controller
{
  protected ?Request $request = null;

  public function render(string $template, ?array $data = []): Response
  {
    $viewPath = BASE_PATH . '/app/views/' . $template . '.html';
    $layoutPath = BASE_PATH . '/app/views/_layout.html';

    if (!file_exists($viewPath)) {
      return new Response('View not found', 404, [
        'Content-Type' => 'text/plain',
      ]);
    }

    ob_start();
    extract($data);
    include $viewPath;
    $content = ob_get_clean();

    ob_start();
    extract($data);
    include $layoutPath;
    $content = ob_get_clean();

    return new Response($content, 200, ['Content-Type' => 'text/html']);
  }

  public function setRequest(Request $request): void
  {
    $this->request = $request;
  }
}
