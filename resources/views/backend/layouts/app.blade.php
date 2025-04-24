<!DOCTYPE html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>{{ config('app.name', 'Regano Pasteria') }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="robots" content="none">
    <link rel="icon" href="/assets/backend/images/favicon.svg" type="image/x-icon" />
    <script src="/assets/backend/js/plugins/simplebar.min.js"></script>
    <script src="/assets/backend/js/fonts/custom-font.js"></script>
    @vite(['resources/css/backend.css', 'resources/js/backend.js'])
  </head>
  <body>
    @yield('content')
  </body>
</html>
