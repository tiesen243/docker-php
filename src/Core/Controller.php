<?php

namespace Framework\Core;

use Framework\Http\Request;
use Framework\Http\Response;

abstract class Controller extends Template
{
  protected ?Request $request = null;

  public function render($template, $data = [])
  {
    $content = parent::render($template, $data);
    return new Response($content, 200, [
      'Content-Type' => 'text/html; charset=UTF-8',
    ]);
  }

  protected function json(array $data): Response
  {
    return new Response(json_encode($data), 200, [
      'Content-Type' => 'application/json',
    ]);
  }

  public function setRequest(Request $request): void
  {
    $this->request = $request;
  }
}
