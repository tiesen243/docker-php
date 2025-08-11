<?php

namespace Framework\Http;

class Response
{
  /**
   * Create a new Response instance.
   *
   * @param string|null $content The content of the response.
   * @param int $statusCode The HTTP status code (default is 200).
   * @param array $headers An associative array of headers (default is empty).
   */
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

  /**
   * Send the response to the client. This method outputs the content of the
   * response and sets the appropriate headers. It is typically called at
   * the end of the request lifecycle.
   *
   * @return void
   */
  public function send(): void
  {
    echo $this->content;
  }

  /**
   * Get the content of the response. This method is primarily used for unit
   * testing purposes.
   *
   * @return string|null The content of the response, or null if not set.
   */
  public function getContent(): ?string
  {
    return $this->content;
  }
}
