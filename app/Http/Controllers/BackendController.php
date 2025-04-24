<?php

namespace App\Http\Controllers;

class BackendController extends Controller {
  public function __invoke() {
    return view('backend.dashboard');
  }
}
