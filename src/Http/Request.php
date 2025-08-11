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
    if ($parsedUri !== '/') {
      $parsedUri = rtrim($parsedUri, '/');
    }

    return [
      'uri' => $parsedUri,
      'method' => $this->server['REQUEST_METHOD'] ?? '',
      'ip' => $this->server['REMOTE_ADDR'] ?? '',
      'user_agent' => $this->server['HTTP_USER_AGENT'] ?? '',
      'host' => $this->server['HTTP_HOST'] ?? '',
    ];
  }

  public function query(): array
  {
    return $this->get;
  }

  public function body(): array
  {
    return $this->post;
  }
}
