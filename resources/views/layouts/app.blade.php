<!DOCTYPE html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>@yield('title')</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="keywords" content="@yield('keywords')">
      <meta name="description" content="@yield('description')">
      <meta name="robots" content="all">
      <meta name="author" content="{{ isset($settings['sitename']) ? $settings['sitename'] : config('app.name') }}">

      <meta property="og:title" content="@yield('title')">
      <meta property="og:description" content="@yield('description')">
      <meta property="og:image" content="@yield('image')">
      <meta property="og:type" content="website">
      <meta property="og:url" content="{{ url()->current() }}">
      <meta property="og:site_name" content="{{ isset($settings['sitename']) ? $settings['sitename'] : config('app.name') }}">

      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:title" content="@yield('title')">
      <meta name="twitter:description" content="@yield('description')">
      <meta name="twitter:image" content="@yield('image')">
      <meta name="twitter:site" content="{{ isset($settings['sitename']) ? $settings['sitename'] : config('app.name') }}">
      <meta name="twitter:url" content="{{ url()->current() }}">
      <meta name="twitter:creator" content="@yield('twitter')">

      <link rel="shortcut icon" href="{{asset('favicon.svg')}}" type="image/svg">
      @include('partials.styles')
    </head>
    <body>
    <div class="wrapper">
      @php
      $pages = Helper::staticPages();
      @endphp
      @include('partials.header', [
        'sitename' => isset($settings['sitename']) ? $settings['sitename'] : config('app.name'),
        'pages' => $pages
      ])
      <main>
        @includeWhen(request()->is('/'), 'partials.hero')
        @includeWhen(request()->is('about'), 'partials.hero-about')
        @includeWhen(request()->is('catalog'), 'partials.hero-catalog')
        @includeWhen(request()->is('distributors'), 'partials.hero-distributors')

        @yield('content')

        @includeWhen(request()->is('/') || request()->is('about') || request()->is('distributors') || request()->is('catalog'), 'partials.numbers')
      </main>
      @include('partials.footer', ['sitename' => isset($settings['sitename']) ? $settings['sitename'] : config('app.name')])
    </div>
    @include('partials.scripts')
    @stack('scripts')
  </body>
</html>
