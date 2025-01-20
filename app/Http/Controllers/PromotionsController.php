<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Http;
//use Illuminate\Support\Collection;

use App\Models\Rubric;
use App\Models\Post;

class PromotionsController extends Controller {

  public $page;

  public function __construct() {
    $this->page = cache()->remember('pages.promotions', now()->addDays(7), fn() => DB::table('pages')->where('slug','promotions')->where(['status' => true, 'lang' => 'ru'])->first());
    if(is_null($this->page)) {
      abort(404);
    }
  }

  public function list(Request $request) {

    //dd($request->url());
    if($request->path() != 'promotions' ) {
      abort(404);
    }

    if($request->method() != 'GET' ) {
      abort(404);
    }

    if( !$request->isMethod('GET') ) {
      abort(404);
    }

    if( $request->hasHeader('X-Header-Name') ) {
      //abort(404);
    }

    if( $request->is('admin/*') ) {
      //abort(404);
    }

    if( $request->routeIs('admin.*') ) {
      //abort(404);
    }

    //dd($request->bearerToken());
    //dd($request->ip());
    //dd($request->getAcceptableContentTypes());
    //dd($request->query());

    if( $request->accepts(['text/html','application/json']) ) {
      //abort(404);
    }

    /* if( cache()->has('promotions') ) {
      $promotions = cache()->get('promotions');
    } else { */
      $rubric = $this->getRubric('promotions');
    /*   cache()->forever('promotions', $promotions);
    }  */
    
    return response()->view('promotions.index', [
      'page' => $this->page,
      'rubric' => $rubric,
      //'promotions' => $promotions
    ])->header('Content-Type', 'text/html');

  }

  public function getRubric($slug) {
    $rubric = Rubric::where(['slug' => $slug])->first();
    //$promotions = $rubric->posts()->latest()->orderByDesc('created_at')->filter( request(['tag','search','author']) )->paginate(12);
    //$promotions = Post::latest()->orderByDesc('created_at')->filter( request(['tag','search','author']) )->paginate(12);
    return $rubric;
  }

  public function detail($slug) {
    $promotion = DB::table('posts')->where('slug',$slug)->where('status',true)->where('lang','ru')->first();
    if(!$promotion) {
      abort('404', 'Sorry, that promotion was not found');
    }

    //$comment = \App\Models\Comment::find(2);
    //dd($comment->post);
    //dd($post->comments);
    //dd($post->user->roles);

    $previous = Post::where('id', '<', $promotion->id)->select('slug')->orderBy('id','desc')->first();
    $next = Post::where('id', '>', $promotion->id)->select('slug')->orderBy('id')->first();
    
    return response()->view('promotions.detail', [
      //'post' => Post::find(2)->getRubric,
      'promotion' => $promotion,
      'previous' => $previous,
      'next' => $next
    ])->header('Content-Type', 'text/html');

  }

}
