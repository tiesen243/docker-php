<?php

namespace Framework\Core;

use Framework\Http\Response;

class Template
{
  protected string $extends = '';
  protected array $sections = [];
  protected array $resourceDeps = [];

  public function __construct(
    private ?string $templateDir = BASE_PATH . '/resources/views',
    private ?string $resourceDir = BASE_PATH . '/resources',
    private ?string $cacheDir = BASE_PATH . '/.cache/views',
  ) {
    if (!is_dir($this->cacheDir)) {
      if (!mkdir($this->cacheDir, 0775, true) && !is_dir($this->cacheDir)) {
        throw new \RuntimeException(
          "Cannot create cache directory: {$this->cacheDir}",
        );
      }
    }
  }

  public function render($template, $data = []): Response
  {
    $this->extends = '';

    extract($data);

    $cacheFile = $this->compile($template);

    ob_start();
    require $cacheFile;
    $content = ob_get_clean();

    if (!empty($this->extends)) {
      $cacheFile = $this->compile($this->extends);
      ob_start();
      require $cacheFile;
      $content = ob_get_clean();
    }

    return new Response($content, 200, [
      'Content-Type' => 'text/html; charset=UTF-8',
    ]);
  }

  private function compile($template): string
  {
    $templateFile =
      $this->templateDir . '/' . str_replace('.', '/', $template) . '.tpl.php';
    $cacheFile = $this->cacheDir . '/' . md5($templateFile) . '.php';

    $cacheDir = dirname($cacheFile);
    if (!is_dir($cacheDir)) {
      mkdir($cacheDir, 0775, true);
    }

    $needsRecompile = !file_exists($cacheFile);

    if (!$needsRecompile) {
      if (filemtime($cacheFile) < filemtime($templateFile)) {
        $needsRecompile = true;
      } else {
        $metaFile = $cacheFile . '.meta';
        if (file_exists($metaFile)) {
          $deps = unserialize(file_get_contents($metaFile));
          foreach ($deps as $dep) {
            if (file_exists($dep) && filemtime($cacheFile) < filemtime($dep)) {
              $needsRecompile = true;
              break;
            }
          }
        }
      }
    }

    if ($needsRecompile) {
      if (!file_exists($templateFile)) {
        throw new \Exception("Template file not found: $templateFile");
      }

      $this->resourceDeps = [];
      $content = file_get_contents($templateFile);
      $parsed = $this->parse($content);

      if (file_put_contents($cacheFile, $parsed) === false) {
        throw new \RuntimeException("Failed to write cache file: $cacheFile");
      }

      file_put_contents($cacheFile . '.meta', serialize($this->resourceDeps));
    }

    return $cacheFile;
  }

  private function parse($content): string
  {
    // @extends directive
    $content = preg_replace(
      "/@extends\([\"'](.+?)[\"']\)/",
      '<?php $this->extends = "$1" ?>',
      $content,
    );

    // @yield with optional default value
    $content = preg_replace_callback(
      '/@yield\(\s*[\"\'](.+?)[\"\']\s*(?:,\s*[\"\'](.*?)[\"\'])?\s*\)/',
      function ($matches) {
        $name = $matches[1];
        $default = isset($matches[2]) ? $matches[2] : '';
        return '<?php echo $this->sections["' .
          $name .
          '"] ?? "' .
          addslashes($default) .
          '"; ?>';
      },
      $content,
    );

    // @include directive
    $content = preg_replace(
      "/@include\([\"'](.+?)[\"']\)/",
      '<?php echo $this->render("$1"); ?>',
      $content,
    );

    // @section and @endsection directives
    $content = preg_replace(
      "/@section\([\"'](.+?)[\"']\)/",
      '<?php ob_start(); $name = "$1"; ?>',
      $content,
    );
    $content = preg_replace(
      '/@endsection/',
      '<?php $this->sections[$name] = ob_get_clean(); ?>',
      $content,
    );

    // @foreach and @endforeach directives
    $content = preg_replace(
      '/@foreach\s*\((.+?)\)/',
      '<?php foreach($1): ?>',
      $content,
    );
    $content = preg_replace('/@endforeach/', '<?php endforeach; ?>', $content);

    // @if / @else / @endif
    $content = preg_replace('/@if\s*\((.+?)\)/', '<?php if($1): ?>', $content);
    $content = preg_replace('/@else/', '<?php else: ?>', $content);
    $content = preg_replace('/@endif/', '<?php endif; ?>', $content);

    // @php
    $content = preg_replace('/@php/', '<?php ', $content);
    $content = preg_replace('/@endphp/', ' ?>', $content);

    // @resource directive for CSS/JS files
    $content = preg_replace_callback(
      '/@resources\(\s*[\"\'](.+?)[\"\']\s*\)/',
      function ($matches) {
        $relativePath = $matches[1];
        $filePath = $this->resourceDir . '/' . ltrim($relativePath, '/');
        $this->resourceDeps[] = $filePath;

        if (!file_exists($filePath)) {
          return "<!-- Resource file not found: {$filePath} -->";
        }

        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        $fileContent = file_get_contents($filePath);

        if ($ext === 'css') {
          return "<style>\n{$fileContent}\n</style>";
        } elseif ($ext === 'js') {
          return "<script>\n{$fileContent}\n</script>";
        }
        return "<!-- Unsupported resource type: {$ext} -->";
      },
      $content,
    );

    // {{ $variable }} syntax
    $content = preg_replace(
      '/\{\{\s*(.+?)\s*\}\}/',
      '<?php echo htmlspecialchars($1); ?>',
      $content,
    );

    return $content;
  }
}
