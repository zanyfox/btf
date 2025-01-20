<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name', 'Regano Pasteria') }}</title>
    <meta name="robots" content="none">
    <link rel="icon" href="{{ asset('assets/admin/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    @yield('head')
  </head>
  <body>
    <div class="auth-wrapper">
			<div class="auth-content text-center">
        <img src="{{asset('assets/images/company-logo.svg')}}" class="img-fluid mb-4" width="140" alt="">
    		@yield('content')
			</div>
		</div>
    <script src="{{ asset('assets/admin/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/bootstrap.min.js') }}"></script>
    @yield('scripts')
  </body>
</html>