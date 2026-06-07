<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Color;

class ColorsController extends Controller {

  public function index() {
    $colors = Color::all();
    return response()->json([
      'status' => 'ok',
      'colors' => $colors
    ]);
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:2|max:20',
      'code' => 'required|string|min:values:2|max:20|unique:colors,code',
      'status' => 'nullable'
    ]);

    if( !$validator->passes() ) {
      return response()->json([
        'status' => 'fail',
        'message' => 'Something went wrong',
        'errors' => $validator->errors()
      ]);
    }

    $color = Color::create([
      'name' => $request->name,
      'code' => $request->code,
      'status' => $request->status ? true : false
    ]);

    return response()->json([
      'status' => 'success',
      'message' => __('admin.NewRecordCreatedSuccessfully'),
      'color' => $color,
      'colors' => Color::all()
    ]);

  }

  public function update(Request $request, int $id) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string',
      'code' => 'required|string|unique:colors,code,' . $id . ',id',
      'status' => 'nullable'
    ]);

    if($validator->fails()) {
      return response()->json([
        'status' => 'fail',
        'message' => 'Validation went wrong',
        'errors' => $validator->errors()
      ]);
    }

    $color = Color::find($id);
    $color->fill($request->only(['name', 'code', 'status']))->save();

    /* $color = Color::find($id)->update([
      'name' => $request->input('name'),
      'code' => $request->input('code'),
      'status' => $request->input('status') ? true : false
    ]); */

    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordUpdatedSuccessfully'),
      'color' => $color
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
