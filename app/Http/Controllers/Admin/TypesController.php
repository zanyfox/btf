<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Type;

class TypesController extends Controller {
  public function index() {
    $types = Type::all();
    return view('admin.types.index', compact('types'));
  }

  public function list() {
    return Type::all();
  }

  public function create() {
    return view('admin.types.create');
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string',
      'code' => 'required|string|unique:types',
      'status' => 'nullable'
    ]);

    if( !$validator->passes() ) {
      return response()->json([
        'status' => 'fail',
        'message' => 'Something went wrong',
        'errors' => $validator->errors()
      ]);
    }

    Type::create([
      'name' => $request->name,
      'code' => $request->code,
      'status' => $request->status ? true : false
    ]);

    return response()->json([
      'status' => 'success',
      'message' => __('admin.NewRecordCreatedSuccessfully'),
      'records' => Type::all()
    ]);

  }

  public function edit(int $id) {
    $type = Type::findOrFail($id);
    return view('admin.types.edit', ['type' => $type]);
  }

  public function update(Request $request, int $id) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string',
      'code' => 'required|string|unique:types,code,' . $id . ',id',
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

    $result = Type::find($id)->update([
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
    Type::find($id)->delete();
    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordDeletedSuccessfully')
    ]);
    
  }

}
