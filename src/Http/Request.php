<?php

namespace Framework\Http;

class Request
{
  private static $instance = null;

  /**
   * Private constructor to prevent direct instantiation. Use the create method
   * to get an instance.
   *
   * @param array $server The $_SERVER superglobal array.
   * @param array $get The $_GET superglobal array.
   * @param array $post The $_POST superglobal array.
   * @param array $files The $_FILES superglobal array.
   * @param array $cookies The $_COOKIE superglobal array.
   * @param array $env The $_ENV superglobal array.
   */
  public function __construct(
    private array $server,
    private array $get,
    private array $post,
    private array $files,
    private array $cookies,
    private array $env,
  ) {}

  /**
   * Get the singleton instance of the Request class.
   *
   * @return static The singleton instance of the Request class.
   */
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

  /**
   * Get the singleton instance of the Request class.
   *
   * @return static The singleton instance of the Request class.
   */
  public function getServerInfo(): array
  {
    $uri = $this->server['REQUEST_URI'] ?? '';
    $parsedUri = parse_url($uri, PHP_URL_PATH) ?: '';

    return [
      'uri' => $parsedUri,
      'method' => $this->server['REQUEST_METHOD'] ?? '',
      'ip' => $this->server['REMOTE_ADDR'] ?? '',
      'user_agent' => $this->server['HTTP_USER_AGENT'] ?? '',
      'host' => $this->server['HTTP_HOST'] ?? '',
      'cookies' => $this->cookies,
    ];
  }

  /**
   * Get the query parameters from the request.
   *
   * @return array The query parameters as an associative array.
   */
  public function query(): array
  {
    return $this->get;
  }

  /**
   * Get the request body parameters.
   *
   * @return array The body parameters as an associative array.
   */
  public function body(): array
  {
    return $this->post;
  }

  /**
   * Get the uploaded files from the request.
   *
   * @return array The uploaded files as an associative array.
   */
  public function files(): array
  {
    return $this->files;
  }
}
