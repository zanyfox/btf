<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cocur\Slugify\Slugify;
use App\Models\Page;

class PagesController extends Controller {

  public function __construct() {
    $this->middleware('auth')->only(['create','edit','update','destroy']);
    //$this->middleware('guest');
  }

  public function index() {
    return view('admin.pages.index', [
      'pages' => Page::all()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return view('admin.pages.create', [
      'pages' => Page::all()
    ]);
  } 

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {

    /* dd($request->pictures);
    exit(); */
    /* $request->validate([
      'name' => 'required|string|unique:goods|min:3|max:255',
      'picture' => ['image','mimes:jpg,jpeg,png,gif,svg','max:5048'],
      'price' => 'required|min:0|integer'
    ]); */

    request()->validate([
      'title' => 'required'
    ]);

    if(empty($request->input('slug'))) {
      $slugify = new Slugify();
      $slug = $slugify->slugify($request->input('title'));
    } else {
      $slug = $request->input('slug');
    }

    $custom = $request->input('custom');
    if(!empty($custom)) {
      $custom_encoded = json_encode($custom, JSON_UNESCAPED_UNICODE);
    }

    /* if( request('picture') && $request->file('picture')->isValid() ) {
      //$picture = $this->storeImage($request);
      $good->picture = request('picture')->store('goods', 'public'); // $request->picture->move(public_path('pictures'), $newImageName);
    } */

    Page::create([
      'metatitle' => $request->input('metatitle'),
      'keywords' => $request->input('keywords'),
      'description' => $request->input('description'),
      'robots' => $request->input('robots'),
      'title' => $request->input('title'),
      'slug' => $slug,
      'subtitle' => $request->input('subtitle'),
      'text' => $request->input('text'),
      'custom' => isset($custom_encoded) ? $custom_encoded : '',
      'lang' => $request->input('lang') ?? 'ru',
      'parent_id' => $request->input('parent_id'),
      'sort' => $request->input('sort') ? (int)$request->input('sort') : 1,
      'status' => boolval($request->input('status'))
    ]);

    return redirect('/admin/pages')->with('success', 'Page has been added');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Page $page) {
    return redirect('/admin/pages/'.$page->id.'/edit');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $page = Page::find($id);
    return view('admin.pages.edit', [
      'pages' => Page::all()->where('id','!=',$id),
      'page' => $page
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {

    request()->validate([
      'title' => 'required',
      'slug' => 'required'
    ]);

    $custom = $request->input('custom');
    if(!empty($custom)) {
      $custom_encoded = json_encode($custom, JSON_UNESCAPED_UNICODE);
    }

    /* $updatedFields = $request->except('_token','_method');
    $result = Page::where('id',$id)->update($updatedFields); */
    $result = Page::where('id',$id)->update([
      'metatitle' => $request->input('metatitle'),
      'keywords' => $request->input('keywords'),
      'description' => $request->input('description'),
      'robots' => $request->input('robots'),
      'title' => $request->input('title'),
      'slug' => $request->input('slug'),
      'subtitle' => $request->input('subtitle'),
      'text' => $request->input('text'),
      'custom' => isset($custom_encoded) ? $custom_encoded : '',
      'lang' => $request->input('lang') ?? 'ru',
      'sort' => $request->input('sort') ?? 1,
      'parent_id' => $request->input('parent_id'),
      'status' => boolval($request->input('status'))
    ]);

    $request->session()->flash('success', 'Page has been updated');
    return redirect('/admin/pages');

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $page = Page::find($id);

    if(!$page) {
      session()->flash('fail', 'Page not found');
      return response()->json([
        'status' => 'fail',
        'message' => 'Page not found'
      ]);
    }

    $page->delete();
    session()->flash('success', 'Page deleted succefully');
    return response()->json([
      'status' => 'success',
      'message' => 'Page deleted succefully'
    ]);
    
  }
}
