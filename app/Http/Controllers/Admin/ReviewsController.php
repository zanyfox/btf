<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use File;
use App\Models\Review;

class ReviewsController extends Controller {

  public function index() {
    $reviews = Review::all();
    return view('admin.reviews.index', compact('reviews'));
  }

  public function create() {
    return view('admin.reviews.create');
  }

  public function store(Request $request) {

    $request->validate([
      'name' => ['required','string','min:3','max:255'],
      'content' => ['required','string'],
      'picture' => ['nullable','image','mimes:jpg,jpeg,png'],
      'status' => ['nullable']
    ]);

    $review = new Review;
    $review->name = $request->input('name');
    $review->content = $request->input('content');
    $review->status = (bool)$request->input('status');  

    if($request->hasFile('picture')) {
      $file = $request->file('picture');
      $ext = $file->getClientOriginalExtension();
      $filename = Str::random(10) . '.' . $ext;
      $file->move('uploads/reviews', $filename);
      $review->picture = $filename;
    }

    $review->save();
    return redirect('admin/reviews')->with('success', __('admin.RecordHasBeenCreatedSuccessfully'));
  }

  public function edit(int $id) {
    $review = Review::findOrFail($id);
    return view('admin.reviews.edit', ['review' => $review]);
  }

  public function update(Request $request, int $id) {

    $review = Review::findOrFail($id);

    $request->validate([
      'name' => ['required','string','min:3','max:255'],
      'content' => ['required','string'],
      'picture' => ['nullable','image','mimes:jpg,jpeg,png'],
      'status' => ['nullable']
    ]);

    $review->name = $request->input('name');
    $review->content = $request->input('content');
    $review->status = (bool)$request->input('status');  

    if($request->hasFile('picture')) {

      if( File::exists( 'uploads/reviews/' . $review->picture) ) {
        File::delete( 'uploads/reviews/' . $review->picture );
      }

      $file = $request->file('picture');
      $ext = $file->getClientOriginalExtension();
      $filename = Str::random(10) . '.' . $ext;
      $file->move('uploads/reviews', $filename);
      $review->picture = $filename;
    }

    $review->save();
    $request->session()->flash('success', __('admin.RecordHasBeenUpdated'));
    return redirect('admin/reviews');

  }

  public function destroy(int $id) {
    try {
      $review = Review::findOrFail($id);
      if( File::exists( 'uploads/reviews/' . $review->picture) ) {
        File::delete( 'uploads/reviews/' . $review->picture );
      }
      $review->delete();
      Session::flash('success', __('admin.RecordHasBeenRemoved'));
      return redirect('admin/reviews');
    } catch(Exception $e) {
      throw new Exception('Something went wrong');
    }
  }

}
