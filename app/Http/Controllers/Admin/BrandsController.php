<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Cocur\Slugify\Slugify;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Brand;

class BrandsController extends Controller {

  public function index() {
    return view('admin.brands.index', ['brands' => Brand::all()]);
  }

  public function create() {
    return view('admin.brands.create');
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:1|max:255',
      'slug' => 'nullable|string|min:1|max:255|unique:brands',
      'status' => 'nullable|boolean'
    ], [
      'name.required' => 'Название бренда не может быть пустым',
      'name.min' => 'Название бренда должно быть не менее 3 символов',
    ]);

    if( $validator->fails() ) {
      session()->flash('fail', 'Something went wrong');
      return response()->json([
        'status' => 'fail',
        'message' => 'Something went wrong',
        'errors' => $validator->errors()
      ]);
    }

    $brand = new Brand();
    $brand->fill([
      'name' => $request->name,
      'slug' => $request->slug ? $request->slug : Str::slug($request->name),
      'description' => $request->description,
      'order_by' => (int)$request->order_by,
      'status' => $request->status ? true : false
    ]);
    $brand->save();

    if($request->has('picture') && !empty($request->picture)) {
      $fileName = Str::random(16) . '.webp';
      $tempFile = public_path('temp/' . $request->picture);
      
      $picture = Image::read($tempFile);
      $picture->toWebp(100);

      $uploadDir = 'uploads/brands/';
      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
      }

      $picture->save(public_path($uploadDir . $fileName));
      $brand->picture = $fileName;
      $brand->save();
    }

    session()->flash('success', __('admin.NewRecordCreatedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.NewRecordCreatedSuccessfully')
    ]);

  }

  public function show($id) {
    return redirect('admin/brands/' . $id . '/edit');
  }

  public function edit(int $id) {
    $brand = Brand::findOrFail($id);
    return view('admin.brands.edit', ['brand' => $brand]);
  }

  public function update(Request $request, int $id) {

    $brand = Brand::find($id);

    $validator = Validator::make($request->all(), [
      'name' => 'required|string',
      'slug' => 'nullable|string|unique:brands,slug,' . $brand->id . ',id',
      'status' => 'nullable|boolean'
    ]);

    if($validator->fails()) {
      session()->flash('fail', 'Validation went wrong');
      return response()->json([
        'status' => 'fail',
        'message' => 'Validation went wrong',
        'errors' => $validator->errors()
      ]);
    }
    
    $brand->name = $request->input('name');
    $brand->slug = $request->input('slug') ? $request->input('slug') : Str::slug($request->input('name'));
    $brand->description = $request->input('description');
    $brand->order_by = (int)$request->input('order_by');
    $brand->status = $request->input('status') ? true : false;
    $brand->save();

    if($request->has('picture') && !empty($request->picture)) {
      $fileName = Str::random(16) . '.webp';
      $tempFile = public_path('temp/' . $request->picture);
      
      $picture = Image::read($tempFile);
      $picture->toWebp(100);

      $uploadDir = 'uploads/brands/';
      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
      }

      $picture->save(public_path($uploadDir . $fileName));

      if($brand->picture) {
        File::delete( public_path('uploads/brands/' . $brand->picture) );
      }

      $brand->picture = $fileName;
      $brand->save();
    }

    session()->flash('success', __('admin.RecordUpdatedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordUpdatedSuccessfully')
    ]); 

  }

  public function changeStatus(int $id) {
    $brand = Brand::find($id);
    $brand->status = !$brand->status;
    $brand->save();
    session()->flash('success', __('admin.StatusChangedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.StatusChangedSuccessfully')
    ]);
  }

  public function removePicture(int $id) {

    $brand = Brand::find($id);
    if($brand->picture) {
      File::delete( public_path('uploads/brands/' . $brand->picture) );
      $brand->picture = null;
      $brand->save();
    }
    session()->flash('success', __('admin.PictureDeletedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.PictureDeletedSuccessfully')
    ]);
    
  }

  public function destroy(int $id) {

    $brand = Brand::find($id);
    if($brand->picture) {
      File::delete( public_path('uploads/brands/' . $brand->picture) );
    }
    $brand->delete();
    session()->flash('success', __('admin.RecordDeletedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordDeletedSuccessfully')
    ]);
    
  }

}
