<!DOCTYPE html>
<html lang="en" class="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>@yield('title', 'Docker PHP')</title>
    @yield('meta', '')

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Geist:wght@100..900&display=swap"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/0fd524a70e.js"
      crossorigin="anonymous"
    ></script>

    @resources('css/globals.css')
  </head>

  <body>
    @include('components.header')

    @yield('content')
  </body>
</html>
