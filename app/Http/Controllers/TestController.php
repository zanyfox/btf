<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller {

  public function __construct() {
    $this->middleware('auth');
  }

  public function index() {

    $promotionsController  = new PromotionsController;
    $promotions = $promotionsController->getAll();
    //print_r($promotions); die;
    $title = $this->transformString('Test title');
    return view('test', compact('title','promotions'));
  }

  private function transformString($str) {
    return strtoupper($str);
  }

}
