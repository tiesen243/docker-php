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

  public function getServerInfo(): array
  {
    $uri = $this->server['REQUEST_URI'] ?? '';
    $parsedUri = parse_url($uri, PHP_URL_PATH) ?: '';

    return [
      'uri' => $parsedUri,
      'method' => $this->server['REQUEST_METHOD'] ?? '',
      'post' => $this->post,
      'get' => $this->get,
    ];
  }
}
