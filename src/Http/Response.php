<?php

namespace Framework\Http;

class Response
{
  public function __construct(
    private ?string $content = '',
    private int $statusCode = 200,
    private array $headers = [],
  ) {
    http_response_code($this->statusCode);
    foreach ($this->headers as $name => $value) {
      header("$name: $value");
    }
  }

  public function send(): void
  {
    echo $this->content;
  }

  public function getContent(): ?string
  {
    return $this->content;
  }
}
