<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Slide;
use DB;
use Str;
use Session;
use Storage;
use Illuminate\Support\Facades\File;

use Intervention\Image\Laravel\Facades\Image;

class MainsliderController extends Controller {

  public $uploadPath = 'uploads/mainslider/';

  public function index() {
    //return view('admin.mainslider.index', ['slides' => Slide::all()]);
    return view('admin.mainslider.index', ['slides' => Slide::with('picture')->get()]);
  }

  public function create() {
    return view('admin.mainslider.create');
  }

  public function store(Request $request) {

    $request->validate([
      'name' => ['required',Rule::unique('slides', 'name'),'min:3','max:255'],
      'picture' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5000',
      'preview' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5000',
      'order_by' => ['nullable','numeric','between:0,100'],
      'status' => 'sometimes'
    ]);

    try {
      DB::beginTransaction();

      $slide = new Slide();
      $slide->name = $request->name;
      $slide->tagline = $request->tagline;
      $slide->description = $request->description;
      $slide->link = $request->link;
      $slide->lang = $request->lang ?? config('app.locale');
      $slide->order_by = (int)$request->order_by;
      $slide->status = (bool)$request->status;

      

      //if( $request->hasFile('picture') ) {

        //$clientOriginalName = $request->picture->getClientOriginalName();
        //$request->picture->move(public_path('uploads/mainslider'), $clientOriginalName);

        /* $picture = new \App\Models\Picture();
        $picture->path = 'mainslider/' . $clientOriginalName;
        $picture->save();

        $slide->picture_id = $picture->id; */

        //$slide->picture = $clientOriginalName;

        /* $file = $request->file('picture')->store('mainslider', 'public');
        $slide->picture = $file; */
      //}

      

      /* if( $request->hasFile('preview') ) {
        $file = $request->file('preview')->store('mainslider/preview', 'public');
        $slide->preview = $file;
      } */

      $randomString = Str::random(16); // Str::uuid()->toString();

      if( $request->hasFile('picture') ) {
        $file = $request->file('picture');
        $image = Image::read($file);
        $image->toWebp(60);
        $image->scaleDown(width: 1920);
        $filename = $randomString . '.webp';
        if($image->save( $this->uploadPath . $filename)) {
          $slide->picture = $filename;
        }
      }

      if( $request->hasFile('preview') ) {
        $file = $request->file('preview');
        $image = Image::read($file);

        // Определение новых размеров
        $newWidth = 768; // Желаемая ширина обрезанного изображения
        $newHeight = $image->height(); // Сохраняем текущую высоту

        // Обрезка изображения по центру
        $image->crop($newWidth, $newHeight, ($image->width() - $newWidth) / 2, 0);
        //$image->scaleDown(width: 768);
        $image->toWebp(60);

        $filename = 'preview_' . $randomString . '.webp';
        if($image->save( $this->uploadPath . $filename)) {
          $slide->preview = $filename;
        }
      }

      $slide->save();

      DB::commit();

      return redirect('admin/mainslider')->withSuccess(__('admin.NewSlideHasBeenCreatedSuccessfully'));

    } catch(\Exception $e) {
      DB::rollback();
      return back()->with($e);
    }
  }

  public function edit($id) {
    $slide = Slide::findOrFail($id);
    return view('admin.mainslider.edit', [
      'slide' => $slide
    ]);
  }

  public function update(Request $request, $id) {

    $slide = Slide::findOrFail($id);

    $request->validate([
      'name' => ['required','min:3','max:255'],
      'picture' => 'nullable|mimes:png,jpg,jpeg,webp|max:5000',
      'preview' => 'nullable|mimes:png,jpg,jpeg,webp|max:5000',
      'order_by' => ['nullable','numeric','between:0,100'],
      'status' => 'sometimes'
    ]);

    $slide->name = $request->input('name');
    $slide->tagline = $request->input('tagline');
    $slide->description = $request->input('description');
    $slide->link = $request->input('link');
    $slide->lang = $request->input('lang') ?? config('app.locale');
    $slide->order_by = $request->input('order_by');
    $slide->status = (bool)$request->input('status');

    $randomString = Str::random(16);

    if( request('picture') ) {

      if(File::exists($this->uploadPath . $slide->picture) ) {
        File::delete($this->uploadPath . $slide->picture);
      }

      $file = $request->file('picture');
      $image = Image::read($file);
      $image->toWebp(60);
      $image->scaleDown(width: 1920);
      $filename = $randomString . '.webp';
      if($image->save( $this->uploadPath . $filename)) {
        $slide->picture = $filename;
      }
    }

    if( request('preview') ) {

      if(File::exists($this->uploadPath . $slide->preview) ) {
        File::delete($this->uploadPath . $slide->preview);
      }

      $file = $request->file('preview');
      $image = Image::read($file);
      
      
      // Определение новых размеров
      $newWidth = 768; // Желаемая ширина обрезанного изображения
      $newHeight = $image->height(); // Сохраняем текущую высоту

      // Обрезка изображения по центру
      $image->crop($newWidth, $newHeight, ($image->width() - $newWidth) / 2, 0);
      //$image->scaleDown(width: 768);
      $image->toWebp(60);

      $filename = 'preview_' . $randomString . '.webp';
      if($image->save( $this->uploadPath . $filename)) {
        $slide->preview = $filename;
      }
    }

    $slide->save();
    return redirect('admin/mainslider')->withSuccess(__('admin.SlideHasBeenUpdatedSuccessfully'));
  }

  public function destroy($id) {
    try {
      $slide = Slide::find($id);

      if(File::exists($this->uploadPath . $slide->picture) ) {
        File::delete($this->uploadPath . $slide->picture);
      }

      if(File::exists($this->uploadPath . $slide->preview) ) {
        File::delete($this->uploadPath . $slide->preview);
      }

      /* if($slide->picture) {
        Storage::delete($slide->picture);
      }
      if($slide->preview) {
        Storage::delete($slide->preview);
      } */
      $slide->delete();
      Session::flash('success', __('admin.SlideHasBeenRemoved'));
      return back();
    } catch(Exception $e) {
      //throw new Exception('Error!!');
      dd($e);
    }
  }

  public function removeImage(int $id, $type) {
    $slide = Slide::findOrFail($id);

    if($type == 'preview') {
      if(File::exists($this->uploadPath . $slide->preview) ) {
        File::delete($this->uploadPath . $slide->preview);
      }
      $slide->preview = null;
    }

    if($type == 'picture') {
      if(File::exists($this->uploadPath . $slide->picture) ) {
        File::delete($this->uploadPath . $slide->picture);
      }
      $slide->picture = null;
    }

    $slide->save();
    
    Session::flash('success', __('admin.PictureDeletedSuccessfully'));
    return back();
    //return response()->json(['status' => 'success']);
  }

}
