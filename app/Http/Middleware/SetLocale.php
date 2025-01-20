<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class SetLocale {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next) {

    //dd();

    /* if( App::isLocale('ru') ) {
      $locale = 'ru';
    } else {
      $locale = $request->locale;
    } */

    
    

    $defaultLocale = 'ru';

    /* if( Auth::user()->lang ) {
      $defaultLocale = Auth::user()->lang;
    } */

    /* if( $request->segment(1) == 'ru' || $request->segment(1) == 'en'  ) {
      $defaultLocale = $request->segment(1);
    }
    app()->setLocale($defaultLocale); */

    //dd();

    //$locale = session('locale');
    $locale = $request->locale ? $request->locale : $defaultLocale;
    
    if( App::currentLocale() != $locale ) {
      App::setLocale($locale);
      
    }
    return $next($request);
  }
}
