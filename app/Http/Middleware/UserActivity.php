<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserActivity {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next) {

    $response = $next($request);

    if( Auth::check() ) {
      $logData = [
        'user_id' => Auth::user()->id,
        'url' => $request->fullUrl(),
        'method' => $request->method(),
        'ip_address' => $request->ip(),
      ];

      Storage::disk('public')->append('logs/user-activity.log', json_encode($logData));

    }

    return $response;
  }
}
