<?php

namespace Yuki\Core;

use Yuki\Http\Response;

abstract class Controller
{
  public function render(string $template, ?array $data = []): Response
  {
    $viewPath = BASE_PATH . '/app/views/' . $template . '.html';

    if (!file_exists($viewPath)) {
      return new Response('View not found', 404, [
        'Content-Type' => 'text/plain',
      ]);
    }

    ob_start();
    extract($data);

    include $viewPath;
    $content = ob_get_clean();

    return new Response($content, 200, ['Content-Type' => 'text/html']);
  }
}
