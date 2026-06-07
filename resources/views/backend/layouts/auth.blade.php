
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8" />
    <meta name="robots" content="none">
    <title>@yield('title') | {{ config('app.name', 'Regano Pasteria') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/backend/images/favicon.svg') }}" type="image/x-icon">
    @vite(['resources/css/backend.css', 'resources/js/backend.js'])
  </head>
  <body>
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>
    @yield('content')
  </body>
</html>
