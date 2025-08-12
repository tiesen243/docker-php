<?php

namespace Framework\Core;

use Framework\Http\Request;
use Framework\Http\Response;

abstract class Controller
{
  protected ?Request $request = null;

  /**
   * Render a view template with optional data and layout.
   *
   * @param string $template The name of the template file (without extension).
   * @param array|null $data Optional data to pass to the view.
   * @param string|null $layout Optional layout file to use (default is 'base').
   * @return Response The rendered response.
   */
  protected function render(
    string $template,
    ?array $data = [],
    ?string $layout = 'base',
  ): Response {
    $viewPath = BASE_PATH . '/app/Views/' . $template . '.php';
    $layoutPath = BASE_PATH . '/app/Views/_layouts/' . $layout . '.php';

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

  /**
   * Return a JSON response with the given data.
   *
   * @param array $data The data to encode as JSON.
   * @return Response The JSON response.
   */
  protected function json(array $data): Response
  {
    return new Response(json_encode($data), 200, [
      'Content-Type' => 'application/json',
    ]);
  }

  /**
   * Set the request object for the controller.
   *
   * @param Request $request The request object.
   * @return void
   */
  public function setRequest(Request $request): void
  {
    $this->request = $request;
  }
}
