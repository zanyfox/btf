<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller {

  public function __construct() {
    //$this->middleware('auth');
  }
  public function __invoke() {

    //$version = app()->version();
    //echo $version; die;

    //phpinfo();die;
    //dd(Hash::make('42tHB7hn'));die;

    /* if(!Auth::check()) {
      return redirect('/login');
    }
    if(Auth::user()->role_id != 2 ) {
      return redirect('/login');
    } */
    //dd(Auth::guard('web')->check());
    //dd(Auth::guard('admin')->check());
    //dd(Auth::check());
    //dd(auth()->user()->role_id);
    return view('backend.app');
  }
}
