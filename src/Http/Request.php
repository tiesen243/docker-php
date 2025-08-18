<?php

namespace Framework\Http;

class Request
{
  private static $instance = null;

  public function __construct(
    private array $server,
    private array $get,
    private array $post,
    private array $files,
    private array $cookies,
    private array $env,
  ) {}

  public static function create(): static
  {
    if (self::$instance === null) {
      self::$instance = new static(
        $_SERVER,
        $_GET,
        $_POST,
        $_FILES,
        $_COOKIE,
        $_ENV,
      );
    }
    return self::$instance;
  }

  public function getUri(): string
  {
    $uri = $this->server['REQUEST_URI'] ?? '';
    $parsedUri = parse_url($uri, PHP_URL_PATH) ?: '';
    return $parsedUri;
  }

  public function getMethod(): string
  {
    return $this->server['REQUEST_METHOD'] ?? '';
  }

  public function query(): array
  {
    return $this->get;
  }

  public function body(): array
  {
    return [...$this->post, ...$this->files];
  }
}
