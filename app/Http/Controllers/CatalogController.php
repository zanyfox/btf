<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\App;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Page;
use App\Models\Category;
use App\Models\Good;

//use App\Http\Traits\GoodFeaturesTrait;

class CatalogController extends Controller {

  //use GoodFeaturesTrait;

  public function index() {
    //Cache::flush();
    $page = Cache::rememberForever('pages.catalog', fn () => Page::where(['slug'=>'catalog','status'=>true])->first());

    if(!$page) {
      abort(404);
    }

    $categories = Cache::remember('catalog.categories', now()->addDays(30), function () {
      return Category::orderByColumn('order_by','ASC')
      ->where(['parent_id' => NULL])
      ->activeStatus()
      ->with('goods')
      ->take(100)->get();
    });

    return view('catalog.index')->with(['page' => $page, 'categories' => $categories]);
  }

  public function category(string $slug) {
    $id = Category::where('slug', $slug)->value('id');
    $category = Category::with('goods')->find($id);

    if(!$category) {
      abort(404);
    }

    $category->loadCount('goods');
    //dd($category->goods);

    $categoryGoods = Good::whereHas('categories', function ($query) use ($id) {
      $query->where('category_id', $id);
    })->select('id','name','slug','price')->paginate(20);

    dd($categoryGoods);

    return view('catalog.category')->with(['category' => $category]);
  }

  public function details(Request $request, string $category, int $id) {



    if(!$id) {

      return $this->index();

      /* return response()->json([
        'status' => 'fail',
        'message' => __('IdIsNotCorrect')
      ]); */
    }

    /* Request Instance */


    //$value = $request->session()->pull('viewedGoods', []);

    /* if($request->session()->has('viewedGoods')) {
      $viewedGoods = [];
    } */



    /* if($request->session()->exists('viewedGoods')) {
      //$request->session()->forget('viewedGoods');
      //$request->session()->forget(['viewedGoods','wishedGoods']);
      $request->session()->flush();
    } */

    /* if($request->session()->missing('viewedGoods')) {
      $viewedGoods = [];
    } */

    // Retrieving Data
    $viewedGoods = $request->session()->get('viewedGoods', []);
    // Storing Data
    array_push($viewedGoods, $id);
    $request->session()->put('viewedGoods', $viewedGoods);

    /* $request->session()->flash('status', 'Viewed');
    $request->session()->keep(['name','email']);
    $request->session()->now('status', 'Viewed'); */


    /* return response()->json([
      'status' => 'test',
      'viewedGoods' => $viewedGoods
    ]); */

    $good = Good::with('brand')->active()->find($id);
    if(!$good) {
      return response()->json([
        'status' => 'fail',
        'message' => __('GoodNotFound')
      ]);
    }

    $goodWeight = null;
    $goodFeatures = DB::select('SELECT * FROM features AS f JOIN feature_good AS fg ON f.id = fg.feature_id WHERE fg.good_id=?', [$good->id]);
    //$goodFeatures = $this->features($good->id);
    if($goodFeatures) {
      foreach($goodFeatures as $feature) {
        if($feature->slug == 'weight') {
          $goodWeight = $feature->value;
        }
      }
    }
    $relatedGoods = [];
    if($good->related_goods) {
      $relatedGoodsIds = explode(',', $good->related_goods);
      $relatedGoods = Good::whereIn('id', $relatedGoodsIds)
        ->where('status', true)
        ->with('categories')->with('pictures')->take(8)->get();
    }

    // Get sibling goods by categories with whereHas filtering
    $categoriesIds = $good->categories->pluck('id')->toArray();
    $siblingGoods = Good::whereHas('categories', function ($query) use ($categoriesIds) {
      $query->whereIn('category_id', $categoriesIds);
    })->where('id', '!=', $good->id)
      ->where('status', true)
      ->with('pictures')
      ->orderBy('id', 'desc')
      ->limit(8)->get(['id', 'name', 'price', 'slug', 'external_id'])->toArray();
    dd($siblingGoods);

    //$good->sizes;

    if($good) {

      $rowId = null;
      $qty = 0;
      $goodRows = Cart::content()->where('id', $good->id);
      foreach ($goodRows as $row) {
        $rowId = $row->rowId;
        $qty = $row->qty;
      }

      return response()->json([
        'status' => 'success',
        'good' => $good,
        'goodPictures' => $good->pictures,
        'goodWeight' => $goodWeight,
        'goodFeatures' => $goodFeatures,
        'relatedGoods' => $relatedGoods,
        'cartRowId' => $rowId,
        'cartQty' => $qty ?? 1
      ]);
    }

  }

  public function getModifiers($goodId) {
    $result = DB::select('SELECT * FROM modifiers AS m JOIN goods AS g ON m.id = g.external_id WHERE g.type = "Modifier" AND m.good_id=' . $goodId);

    $groups = [];
    if(count($result) > 0) {
      foreach($result as $modifier) {
        $groups[$modifier->group_id][] = $modifier;
      }
    }
    $data = collect($result)->map(function($x){ return (array) $x; })->toArray();
    return response()->json([
      'status' => 'success',
      'modifiers' => $data,
      'modifiersGroups' => $groups
    ]);
  }

  public function changeCurrency($code) {
    $currency = \App\Models\Currency::byCode($code)->firstOrFail();
    session(['currency' => $currency->code]);
    return redirect()->back();
  }

  public function updateCurrencyRates() {
    \App\Services\CurrencyRates::getRates();
  }

  public function changeLocale($locale) {

    $availableLocales = ['ru','en'];
    if( !in_array($locale, $availableLocales) ) {
      $locale = config('app.locale');
    }

    session(['locale' => $locale]);
    App::setLocale($locale);
    $currentLocale = App::getLocale();
    return redirect()->back();
  }

}
