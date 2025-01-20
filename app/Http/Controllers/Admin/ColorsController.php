<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Color;

class ColorsController extends Controller {
  public function index() {
    $colors = Color::all();
    return view('admin.colors.index', compact('colors'));
  }

  public function list() {
    return Color::all();
  }

  public function create() {
    return view('admin.colors.create');
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string',
      'code' => 'required|string|unique:colors',
      'status' => 'nullable'
    ]);

    if( !$validator->passes() ) {
      return response()->json([
        'status' => 'fail',
        'message' => 'Something went wrong',
        'errors' => $validator->errors()
      ]);
    }

    Color::create([
      'name' => $request->name,
      'code' => $request->code,
      'status' => $request->status ? true : false
    ]);

    return response()->json([
      'status' => 'success',
      'message' => __('admin.NewRecordCreatedSuccessfully'),
      'records' => Color::all()
    ]);

  }

  public function edit(int $id) {
    $color = Color::findOrFail($id);
    return view('admin.colors.edit', ['color' => $color]);
  }

  public function update(Request $request, int $id) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string',
      'code' => 'required|string|unique:colors,code,' . $id . ',id',
      'status' => 'nullable'
    ]);

    if($validator->fails()) {
      session()->flash('fail', 'Validation went wrong');
      return response()->json([
        'status' => 'fail',
        'message' => 'Validation went wrong',
        'errors' => $validator->errors()
      ]);
    }

    $result = Color::find($id)->update([
      'name' => $request->input('name'),
      'code' => $request->input('code'),
      'status' => $request->input('status') ? true : false
    ]);

    session()->flash('success', __('admin.RecordUpdatedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordUpdatedSuccessfully'),
      'result' => $result
    ]); 

  }

  public function destroy(int $id) {
    Color::find($id)->delete();
    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordDeletedSuccessfully')
    ]);
    
  }

}
