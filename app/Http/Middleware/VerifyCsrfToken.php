<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware {
  /**
   * The URIs that should be excluded from CSRF verification.
   *
   * @var array<int, string>
   */
  protected $except = [
    '/login', // 42tHB7hn // btf101@yandex.ru
    '/api/backend/*',
    '/payment',
    '/payment/*'
  ];
}
