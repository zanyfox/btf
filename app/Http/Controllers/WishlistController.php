<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Good;

class WishlistController extends Controller {
  public function index() {

    throw new \Symfony\Component\HttpKernel\Exception\HttpException(503);

    $goods = [];
    if( Auth::check() ) {
      $wishlistIds = Wishlist::where('user_id', auth()->user()->id)->get()->pluck('good_id')->toArray();
      $goods = Good::whereIn('id', $wishlistIds)->get();
    }
    return view('wishlist/index', compact('goods'));
  }

  public function count() {

    $wishlistCount = 0;
    if( Auth::check() ) {
      $wishlistCount = Wishlist::where('user_id', auth()->user()->id)->count();
    }

    return response()->json([
      'status' => 'success',
      'count' => $wishlistCount
    ]);

  }

  public function add(int $id) {

    // The Global Session Helper

    // Retrieving Data
    $wishedGoods = session('wishedGoods', []);

    // Storing Data
    array_push($wishedGoods, $id);
    session(['wishedGoods' => $wishedGoods]);

    if( Auth::check() ) {

      if( Wishlist::where('user_id', auth()->user()->id)->where('good_id', $id)->exists() ) {
        return response()->json([
          'status' => 'fail',
          'message' => 'Already added to wishlist'
        ]);
      }

      /* $result = Wishlist::create([
        'user_id' => auth()->user()->id,
        'good_id' => $id
      ]); */

      $result = Wishlist::updateOrCreate(
        [
          'user_id' => auth()->user()->id,
          'good_id' => $id
        ],
        [
          'user_id' => auth()->user()->id,
          'good_id' => $id
        ]
      );

      $wishlistCount = Wishlist::where('user_id', auth()->user()->id)->count();

      return response()->json([
        'status' => 'success',
        'message' => 'Good added successfully in your Wishlist',
        'result' => $result,
        'count' => $wishlistCount
      ]);
    } else {
      return response()->json([
        'status' => 'fail',
        'message' => 'Please Login to continue'
      ]);
    }

  }

  public function remove(int $id) {

    /* if( session()->has('wishedGoods') ) {
      session()->forget('wishedGoods');
    } */

    /* if( session()->exists('wishedGoods') ) {
      //session()->forget('wishedGoods');
      session()->forget(['viewedGoods', 'wishedGoods']);
    } */

    if( Auth::check() ) {

      if( !Wishlist::where('user_id', auth()->user()->id)->where('good_id', $id)->exists() ) {
        return response()->json([
          'status' => 'fail',
          'message' => 'Wishlist Item Not Found'
        ]);
      }

      $result = Wishlist::where('user_id', auth()->user()->id)->where('good_id', $id)->delete();

      $wishlistCount = Wishlist::where('user_id', auth()->user()->id)->count();

      return response()->json([
        'status' => 'success',
        'message' => 'Wishlist Item Removed Successfully',
        'count' => $wishlistCount,
        'result' => $result
      ]);
    } else {

      //session(['url.intended' => url()->previous()]);

      return response()->json([
        'status' => 'fail',
        'message' => 'Please Login to continue'
      ]);
    }

  }

}
