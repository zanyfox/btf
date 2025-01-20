<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use DB;
use Cache;
use Illuminate\Support\Facades\Storage;
use App\Models\Gallery;

use App\Models\Page;

class PagesController extends Controller {

  public function aboutUs() {
    return redirect()->route('about');
  }

  public function about() {
    
    $page = Cache::remember('pages.about', now()->addDays(7), function () {
      return DB::table('pages')
        ->where('slug','about')
        ->where('status', true)
        ->where('lang','ru')
        ->first();
    });

    if(!$page) {
      abort(404);
    }

    $custom = [];
    if( !empty($page->custom) ) {
      foreach(json_decode($page->custom) as $item) {
        if( isset($item->alias) ) {
          $custom[$item->alias] = $item;
        }
      }
    }
    
    return view('pages/about', [
      'page' => $page,
      'custom' => $custom,
    ]);
  }

  public function distributors() {
	  
	//dd(__dir__);
	  
    $page = DB::table('pages')->where(['slug' => 'distributors', 'status' => true])->first();
    if(!$page) {
      abort(404);
    }

    $distributors = DB::table('partners')->where(['status' => true])->orderBy('order_by', 'ASC')->get();
	
	$distributorCities = [];
	if($distributors->isNotEmpty()) {
		$distributorCities = array_unique($distributors->pluck('city')->toArray());
		sort($distributorCities);
	}

    return view('pages.distributors', [
      'page' => $page,
      'distributors' => $distributors,
	  'distributorCities' => $distributorCities
    ]);
  }

  public function contact() {
    return redirect('/contacts');
  }

  public function contacts() {
    $page = cache()->remember('pages.contacts', now()->addDays(7), function() {
      return DB::connection('mysql')->table('pages')->where(['slug' => 'contacts', 'status' => true])->first();
    });
    return view('pages/contacts', ['page' => $page]);
  }

  public function privacy() {
    $page = cache()->remember('pages.privacy', now()->addDays(7), function() {
      return DB::connection('mysql')->table('pages')->where(['slug' => 'politika-konfidentsialnosti', 'status' => true])->first();
    });
    return view('pages/privacy', ['page' => $page]);
  }

  public function userAgreement() {
    $page = cache()->remember('pages.userAgreement', now()->addDays(7), function() {
      return DB::connection('mysql')->table('pages')->where(['slug' => 'polzovatelskoe-soglashenie', 'status' => true])->first();
    });
    return view('pages/user-agreement', ['page' => $page]);
  }


}
