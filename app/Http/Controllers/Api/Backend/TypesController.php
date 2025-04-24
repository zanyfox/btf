<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Type;

class TypesController extends Controller {

  public function index() {
    $types = Type::all();
    return response()->json([
      'status' => 'ok',
      'types' => $types
    ]);
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:2|max:20',
      'code' => 'required|string|min:values:2|max:20|unique:types,code',
      //'status' => 'nullable'
    ]);

    if($validator->fails()) {
      return response()->json([
        'status' => 'fail',
        'message' => 'Something went wrong',
        'errors' => $validator->errors()
      ]);
    }

    $type = Type::create([
      'name' => $request->name,
      'code' => $request->code,
      'status' => $request->status ? true : false
    ]);

    return response()->json([
      'status' => 'success',
      'message' => __('admin.NewRecordCreatedSuccessfully'),
      'type' => $type,
      'types' => Type::all()
    ]);

  }

  public function update(Request $request, int $id) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string',
      'code' => 'required|string|unique:types,code,' . $id . ',id',
      'status' => 'nullable'
    ]);

    if($validator->fails()) {
      return response()->json([
        'status' => 'fail',
        'message' => 'Validation went wrong',
        'errors' => $validator->errors()
      ]);
    }

    $result = Type::find($id)->update([
      'name' => $request->input('name'),
      'code' => $request->input('code'),
      'status' => $request->input('status') ? true : false
    ]);

    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordUpdatedSuccessfully'),
      'result' => $result
    ]);

  }

  public function destroy(int $id) {
    Type::find($id)->delete();
    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordDeletedSuccessfully')
    ]);

  }

}
