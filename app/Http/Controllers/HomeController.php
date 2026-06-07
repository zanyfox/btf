<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Good;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller {

  public function __invoke($locale = 'ru') {

    //dd(Hash::make('42tHB7hn'));die;

    //dd(Hash::make('24thb7hn'));die; // 4?qxk*c^4a6sJKb

    // https://chat.deepseek.com/ codecatandquiet@gmail.com 3uz1Bcc66Lah

    //cache()->forget('pages.home');
    $page = cache()->rememberForever('pages.home', function() {
      return DB::connection('mysql')->table('pages')->where(['slug' => 'home', 'status' => true])->first();
    });

    if(!$page) {
      abort(404);
    }

    cache()->forget('home.goods');
    $goods = cache()->remember('home.goods', now()->addDays(30), function() {
      return Good::where('status', true)->where('order_by', '!=', '')->with('pictures')->orderBy('order_by', 'ASC')->limit(12)->get(['id','name']);
    });

    //dd($goods);

    return view('home',compact('page','goods'));
  }

}
