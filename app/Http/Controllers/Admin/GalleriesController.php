<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Gallery;
use App\Models\Picture;
use App\Models\GalleryPicture;
use Cocur\Slugify\Slugify;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Session;
use Str;

use Intervention\Image\Laravel\Facades\Image;

class GalleriesController extends Controller {

  public $messages = [
    'required' => 'Поле :attribute обязательно для заполнения',
    'string' => 'Поле :attribute должно быть строкой',
    'unique' => 'Поле :attribute должно быть уникальным в таблице',
    'min' => 'Поле :attribute должно быть не менее :min символов',
    'max' => 'Поле :attribute должно быть не более :max символов',
  ];

  public $uploadPath = 'uploads/galleries/';

  public function __construct() {
    $this->uploadPath = public_path($this->uploadPath);
  }

  public function index() {
    return view('admin.galleries.index')->with('galleries', Gallery::all());
  }

  public function create() {
    return view('admin.galleries.create');
  }

  public function store(Request $request) {

    $request->validate([
      'name' => 'required|string|unique:galleries,name|min:3|max:255',
      'slug' => 'nullable|string|unique:galleries,slug|min:3|max:255',
      'pictures.*' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
    ], $this->messages);
    
    $gallery = new Gallery();
    $gallery->name = $request->input('name');
    $gallery->slug = $request->input('slug');

    if(empty($gallery->slug)) {
      $slugify = new Slugify();
      $gallery->slug = $slugify->slugify($request->input('name'), '-');
    }

    $gallery->description = $request->input('description');
    $gallery->lang = $request->input('lang');
    $gallery->status = $request->input('status') === 'on';

    if($gallery->save()) {
      Session::flash('success', __('admin.RecordHasBeenCreated'));
    } else {
      Session::flash('fail', __('admin.SomethingWentWrong'));
    }

    if( $request->hasFile('pictures') ) {
      $files = $request->file('pictures');
      foreach($files as $key => $file) {
        $fileName = Str::random(16) . '.webp';
        $image = Image::read($file);
        $image->toWebp(60)->save($this->uploadPath . $fileName);

        $picture = Picture::create([
          'path' => $fileName
        ]);

        $gallery->pictures()->attach($picture->id);

        //GalleryPicture::create(['gallery_id' => $gallery->id,'picture_id' => $picture->id]);
        //DB::insert('INSERT INTO gallery_picture (gallery_id, picture_id) VALUES(?,?)', [$gallery->id, $picture->id]);

      }
    }

    return redirect()->route('admin.galleries.index');

  }

  public function edit($id) {
    $gallery = Gallery::findOrFail($id);
    return view('admin.galleries.edit', compact('gallery'));
  }

  public function update(Request $request, $id) {

    $request->validate([
      'name' => 'required|string|min:3|max:255',
      'slug' => 'nullable|string|min:3|max:255',
      'pictures.*' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
    ], $this->messages);
    
    $gallery = Gallery::findOrFail($id);
    
    $gallery->name = $request->input('name');
    $gallery->slug = $request->input('slug');

    if(empty($gallery->slug)) {
      $slugify = new Slugify();
      $gallery->slug = $slugify->slugify($request->input('name'), '-');
    }

    $gallery->description = $request->input('description');
    $gallery->lang = $request->input('lang');
    $gallery->status = $request->input('status') === 'on';
    
    if( $request->hasFile('pictures') ) {

      $files = $request->file('pictures');
      $picturesId = []; 
      foreach($files as $key => $file) {
        $filename = Str::random(16) . '.webp';
        $image = Image::read($file);
        $image->toWebp(60)->save($this->uploadPath . $filename);

        $picture = Picture::create([
          'path' => $filename
        ]);

        $picturesId[] = $picture->id;

        //GalleryPicture::create(['gallery_id' => $gallery->id,'picture_id' => $picture->id]);
        //DB::insert('INSERT INTO gallery_picture (gallery_id, picture_id) VALUES(?,?)', [$id, $picture->id]);
      }
      if($picturesId) {
        //$gallery->pictures()->detach();
        $gallery->pictures()->attach($picturesId);
      }
      

      //$gallery->pictures()->attach();

    }

    if($gallery->save()) {
      Session::flash('success', __('admin.RecordHasBeenUpdated'));
    } else {
      Session::flash('fail', __('admin.SomethingWentWrong'));
    }
    return redirect()->route('admin.galleries.index');
  }

  public function destroy(int $id) {
    $gallery = Gallery::findOrFail($id);
    if($gallery->pictures) {
      foreach($gallery->pictures as $picture) {
        if(File::exists($this->uploadPath . $picture->path)) {
          File::delete($this->uploadPath . $picture->path);
        }
        //GalleryPicture::where('picture_id', $picture->id)->delete();
        //DB::delete('DELETE FROM gallery_picture WHERE picture_id=? LIMIT 1', [$picture->id]);
      }
      $gallery->pictures()->detach();
    }
    $gallery->delete();
    Session::flash('success', __('admin.RecordHasBeenRemoved'));
    return back();    
  }

  public function deleteimage(int $id) {
    $picture = Picture::findOrFail($id);
    
    if(File::exists($this->uploadPath . $picture->path)) {
      File::delete($this->uploadPath . $picture->path);
    }
    $picture->galleries()->detach();
    //GalleryPicture::where('picture_id', $picture->id)->delete();
    //DB::delete('DELETE FROM gallery_picture WHERE picture_id=? LIMIT 1', [$picture->id]);
    //$gallery = $picture->galleries()->first();
    //$gallery->pictures()->detach($picture->id);
    $picture->delete();
    Session::flash('success', __('admin.PictureHasBeenRemoved'));
    return back();    
  }

  public function sort($id, $sort) {
    $picture = Picture::find($id);
    $picture->sort = $sort;
    if($picture->save()) {
      return response()->json([
        'status' => 'success',
        'message' => 'Image sort changed successfully'
      ]);
    }
    return response()->json([
      'status' => 'fail',
      'message' => 'Something went wrong'
    ]);
  }

}
