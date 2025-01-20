<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Good;
use Illuminate\Support\Facades\App;

class HomeController extends Controller {

  public function __invoke($locale = 'ru') {

    cache()->forget('pages.home');
    $page = cache()->remember('pages.home', now()->addDays(7), function() {
      return DB::connection('mysql')->table('pages')->where(['slug' => 'home', 'status' => true])->first();
    });

    if(!$page) {
      abort(404);
    }

    cache()->forget('home.goods');
    $goods = cache()->remember('home.goods', now()->addDays(7), function() {
      $goods = Good::where('status', true)->where('order_by', '!=', '')->orderBy('order_by', 'ASC')->get();
      return $goods;
    });

    return view('home',compact('page','goods'));
  }
  
}
