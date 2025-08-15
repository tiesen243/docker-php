<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Default Title')</title>
    @yield('meta', '')

    @resources('css/globals.css')
  </head>

  <body>
    @yield('content')
  </body>
</html>
