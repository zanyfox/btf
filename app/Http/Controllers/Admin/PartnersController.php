<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Cocur\Slugify\Slugify;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Partner;

class PartnersController extends Controller {

  public function index() {
    return view('admin.partners.index', ['partners' => Partner::all()]);
  }

  public function create() {
    $max = Partner::max('id') + 1;
    return view('admin.partners.create', compact('max'));
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'company' => 'required|string|min:3|max:255',
      'status' => 'nullable|boolean'
    ], [
      'company.required' => 'Имя партнера не может быть пустым',
      'company.min' => 'Имя партнера должно быть не менее 3 символов',
    ]);

    if( $validator->fails() ) {
      session()->flash('fail', 'Something went wrong');
      return response()->json([
        'status' => 'fail',
        'message' => 'Something went wrong',
        'errors' => $validator->errors()
      ]);
    }

    $partner = new Partner();
    $partner->fill([
      'company' => $request->company,
      'name' => $request->name,
      'surname' => $request->surname,
      'email' => $request->email,
      'phone' => $request->phone,
      'city' => $request->city,
      'address' => $request->address,
      'coordinates' => $request->coordinates,
      'site' => $request->site,
      'schedule' => $request->schedule,
      'order_by' => (int)$request->order_by,
      'status' => $request->status ? true : false
    ]);
    $partner->save();

    if($request->has('picture') && !empty($request->picture)) {
      $fileName = Str::random(16) . '.webp';
      $tempFile = public_path('temp/' . $request->picture);
      
      $picture = Image::read($tempFile);
      $picture->toWebp(100);

      $uploadDir = 'uploads/partners/';
      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
      }

      $picture->save(public_path($uploadDir . $fileName));
      $partner->picture = $fileName;
      $partner->save();
    }

    session()->flash('success', __('admin.NewRecordCreatedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.NewRecordCreatedSuccessfully')
    ]);

  }

  public function show($id) {
    return redirect('admin/partners/' . $id . '/edit');
  }

  public function edit(int $id) {
    $partner = Partner::findOrFail($id);
    return view('admin.partners.edit', ['partner' => $partner]);
  }

  public function update(Request $request, int $id) {

    $partner = Partner::find($id);

    $validator = Validator::make($request->all(), [
      'company' => 'required|string|min:3|max:255',
      'status' => 'nullable|boolean'
    ], [
      'company.required' => 'Имя партнера не может быть пустым',
      'company.min' => 'Имя партнера должно быть не менее 3 символов',
    ]);

    if($validator->fails()) {
      session()->flash('fail', 'Validation went wrong');
      return response()->json([
        'status' => 'fail',
        'message' => 'Validation went wrong',
        'errors' => $validator->errors()
      ]);
    }
    
    $partner->company = $request->input('company');
    $partner->name = $request->input('name');
    $partner->surname = $request->input('surname');
    $partner->email = $request->input('email');
    $partner->phone = $request->input('phone');
    $partner->city = $request->input('city');
    $partner->address = $request->input('address');
    $partner->coordinates = $request->input('coordinates');
    $partner->site = $request->input('site');
    $partner->schedule = $request->input('schedule');
    $partner->order_by = (int)$request->input('order_by');
    $partner->status = $request->input('status') ? true : false;
    $partner->save();

    if($request->has('picture') && !empty($request->picture)) {
      $fileName = Str::random(16) . '.webp';
      $tempFile = public_path('temp/' . $request->picture);
      
      $picture = Image::read($tempFile);
      $picture->toWebp(100);

      $uploadDir = 'uploads/partners/';
      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
      }

      $picture->save(public_path($uploadDir . $fileName));

      if($partner->picture) {
        File::delete( public_path('uploads/partners/' . $partner->picture) );
      }

      $partner->picture = $fileName;
      $partner->save();
    }

    session()->flash('success', __('admin.RecordUpdatedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordUpdatedSuccessfully')
    ]); 

  }

  public function changeStatus(int $id) {
    $partner = Partner::find($id);
    $partner->status = !$partner->status;
    $partner->save();
    session()->flash('success', __('admin.StatusChangedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.StatusChangedSuccessfully')
    ]);
  }

  public function removePicture(int $id) {

    $partner = Partner::find($id);
    if($partner->picture) {
      File::delete( public_path('uploads/partners/' . $partner->picture) );
      $partner->picture = null;
      $partner->save();
    }
    session()->flash('success', __('admin.PictureDeletedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.PictureDeletedSuccessfully')
    ]);
    
  }

  public function destroy(int $id) {

    $partner = Partner::find($id);
    if($partner->picture) {
      File::delete( public_path('uploads/partners/' . $partner->picture) );
    }
    $partner->delete();
    session()->flash('success', __('admin.RecordDeletedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordDeletedSuccessfully')
    ]);
    
  }

}