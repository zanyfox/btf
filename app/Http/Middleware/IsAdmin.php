<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin {

  public function handle(Request $request, Closure $next) {

    /* if( !auth()->check() && !auth()->user()->is_admin) {
      abort(401);
    }

    if( Auth::check() && !auth()->user()->is_admin) {
      abort(403);
    } */

    /* if(\Illuminate\Support\Facades\Auth::user()->role_id != 2) {
      return redirect('/admin/login')->with('message','Access Denied. As you are not admin.');
    } */

    //$user = Auth::user();
    
    //if(!Auth::user()->isAdmin()) {
    if( !Auth::user()->hasRole(['admin', 'super-admin']) ) {
      abort(403);
    }
    return $next($request);
  }

}
