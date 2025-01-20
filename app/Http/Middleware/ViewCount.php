<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ViewCount {
  public function handle(Request $request, Closure $next) {
    // TODO
    //dd($next($request));
    return $next($request);
  }
}
