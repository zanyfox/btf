<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Cocur\Slugify\Slugify;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Laravel\Facades\Image;
use Session;
use Illuminate\Support\Facades\File;
use App\Models\Category;

class CategoriesController extends Controller {

  public $colors;

  public function __construct() {
    $this->colors = DB::table('colors')->select('id','name','code','status')->distinct()->orderBy('id','desc')->get();
  }

  public function index() {
    //$this->authorize('viewAny', Category::class);
    return response()->json(['status' => 'success', 'categories' => Category::all()]);
  }

  public function show(int $id) {
    $category = Category::find($id);
    //$this->authorize('view', $category);
    return response()->json(['status' => 'success', 'category' => $category]);
  }

  public function create(Request $request) {

    /* if( $request->user()->cannot('create', Category::class) ) {
      abort(403, 'You cannot create because you have no permission');
    } */

    //$this->authorize('create', Category::class);

    $max = Category::max('id');
    $max = $max + 1;
    return view('admin.categories.create')->with('categories', Category::select('id','name','parent_id')->orWhereNull('parent_id')->get())->with('max', $max)->with('colors', $this->colors);
  }

  public function store(Request $request) {

    //$this->authorize('create', Category::class);

    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:3|max:191',
      'slug' => 'nullable|string|min:3|max:191|unique:categories'
    ]);

    if( $validator->fails() ) {
      return response()->json([
        'status' => 'fail',
        'message' => __('admin.ValidationWentWrong'),
        'errors' => $validator->errors()
      ]);
    }

    $category = new Category;
    $category->name = $request->name;

    if(empty($request->slug)) {
      $slugify = new Slugify();
      $category->slug = $slugify->slugify($category->name);
    } else {
      $category->slug = $request->slug;
    }

    $category->subtitle = $request->subtitle;
    $category->excerpt = $request->excerpt;
    $category->description = $request->description;
    $category->external_id = $request->external_id;
    $category->parent_id = $request->parent_id;
    $category->color_id = $request->color_id;
    $category->order_by = $request->order_by;
    $category->home = $request->home == 'on';
    $category->status = $request->status == 'on';
    $category->meta_title = $request->meta_title;
    $category->meta_keywords = $request->meta_keywords;
    $category->meta_description = $request->meta_description;
    $category->meta_robots = $request->meta_robots;
    $category->created_at = $category->updated_at = now();

    if($request->has('picture') && !empty($request->picture)) {

      $tempFile = public_path('temp/' . $request->picture);

      $uploadDir = 'uploads/categories/';
      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
      }

      $thumbsUploadDir = 'uploads/categories/thumbs/';
      if (!is_dir($thumbsUploadDir)) {
        mkdir($thumbsUploadDir, 0777, true);
      }

      $extArr = explode('.', $request->picture);
      $ext = last($extArr);

      if($ext == 'svg') {
        $fileName = $request->picture;
        File::copy($tempFile, public_path($uploadDir . $fileName));
        File::copy($tempFile, public_path($thumbsUploadDir . $fileName));
      } else {

        $fileName = Str::random(16) . '.webp';
        $picture = Image::read($tempFile);
        $picture->toWebp(100);

        $thumb = Image::read($tempFile);
        $thumb->toWebp(100);
        /* $thumb->fit(240, 240, function($constraint) {
          $constraint->upsize();
        }); */
        $thumb->save(public_path($thumbsUploadDir . $fileName));
      }

      $category->picture = $fileName;

      //$category->save();
    }

    if( $category->save() ) {
      return response()->json([
        'status' => 'success',
        'message' => __('admin.RecordHasBeenCreated')
      ]);
    }

    return response()->json([
      'status' => 'fail',
      'message' => 'Something went wrong'
    ]);

  }

  public function edit(int $id) {

    $category = Category::findOrFail($id);

    //$this->authorize('update', $category);

    $categories = Category::where('id', '!=', $category->id)->whereNull('parent_id')->select('id','name','parent_id')->get();
    $colors = $this->colors;
    return view('admin.categories.edit', compact('categories','category','colors'));
  }

  public function update(Request $request, int $id) {

    $category = Category::find($id);

    if(!$category) {
      return response()->json([
        'status' => 'fail',
        'message' => __('admin.RecordNotFound')
      ]);
    }

    //$this->authorize('update', $category);

    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:3|max:191',
      'slug' => 'required|string|min:3|max:191|unique:categories,slug, '. $category->id .',id'
    ]);

    if( $validator->fails() ) {
      session()->flash('fail', __('admin.ValidationWentWrong'));
      return response()->json([
        'status' => 'fail',
        'message' => __('admin.ValidationWentWrong'),
        'errors' => $validator->errors()
      ]);
    }

    $category->name = $request->name;

    /* return response()->json([
      'status' => 'test',
      'message' => $category->name
    ]); */

    if( empty($request->slug) ) {
      $slugify = new Slugify();
      $category->slug = $slugify->slugify($category->name);
    } else {
      $category->slug = $request->slug;
    }

    $category->subtitle = $request->subtitle;
    $category->excerpt = $request->excerpt;
    $category->description = $request->description;
    $category->external_id = $request->external_id;
    $category->parent_id = $request->parent_id;
    $category->color_id = $request->color_id;
    $category->order_by = $request->order_by;
    $category->home = $request->home ? true : false;
    $category->status = $request->status ? true : false;
    $category->meta_title = $request->meta_title;
    $category->meta_keywords = $request->meta_keywords;
    $category->meta_description = $request->meta_description;
    $category->meta_robots = $request->meta_robots;
    $category->updated_at = now();

    /* if($request->has('picture') && !empty($request->picture)) {

      $tempFile = public_path('temp/' . $request->picture);

      $uploadDir = 'uploads/categories/';
      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
      }

      $thumbsUploadDir = 'uploads/categories/thumbs/';
      if (!is_dir($thumbsUploadDir)) {
        mkdir($thumbsUploadDir, 0777, true);
      }

      $extArr = explode('.', $request->picture);
      $ext = last($extArr);

      if($ext == 'svg') {
        $fileName = $request->picture;
        File::copy($tempFile, public_path($uploadDir . $fileName));
        File::copy($tempFile, public_path($thumbsUploadDir . $fileName));
      } else {

        $picture = Image::read($tempFile);
        $picture->toWebp(100);

        $fileName = Str::random(16) . '.webp';
        $picture->save(public_path($uploadDir . $fileName));

        $thumb = Image::read($tempFile);
        $thumb->toWebp(100);

        $thumb->fit(240, 240, function($constraint) {
          $constraint->upsize();
        });

        $thumb->save(public_path($uploadDir . 'thumbs/' . $fileName));
      }

      $category->picture = $fileName;

      // Delete old image here
      if( File::exists( '/uploads/categories/' . $category->picture) ) {
        File::delete(public_path() . '/uploads/categories/' . $category->picture);
      }

      if( File::exists('/uploads/categories/thumbs/' . $category->picture) ) {
        File::delete(public_path() . '/uploads/categories/thumbs/' . $category->picture);
      }

    } */

    $category->update();

    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordUpdatedSuccessfully')
    ]);

  }

  public function changeStatus(int $id) {
    $category = Category::whereId($id)->first();
    $category->status = !$category->status;
    $category->save();
    return response()->noContent();
  }

  public function removePicture(int $id) {
    $category = Category::find($id);
    if($category->picture) {
      File::delete( public_path('uploads/categories/' . $category->picture) );
      File::delete( public_path('uploads/categories/thumbs/' . $category->picture) );
      $category->picture = null;
      $category->save();
    }
    return response()->noContent();
  }

  public function destroy(int $id) {

    $category = Category::find($id);

    //$this->authorize('delete', $category);

    if(!$category) {
      return response()->json([
        'status' => 'fail',
        'message' => __('admin.RecordNotFound')
      ]);
    }

    /* if($category->goods()) {
      return response()->json([
        'status' => 'fail',
        'message' => 'Category has goods'
      ]);
    } */

    // TODO Remove relational goods from pivot table
    if($category->picture) {
      File::delete(public_path() . '/uploads/categories/' . $category->picture);
      File::delete(public_path() . '/uploads/categories/thumbs/' . $category->picture);
    }

    $category->delete();
    return response()->json(['status' => 'success', 'message' => __('admin.RecordDeletedSuccessfully')]);



  }
}

