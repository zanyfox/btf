<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class PermissionsController extends Controller {

  public function __construct() {
    $this->middleware('auth');
    //$this->middleware(['auth','AdminCheck','role:super-admin|admin'])->except(['index']);
  }

  public function index() {
    return response()->json(['success' => true, 'permissions' => Permission::latest()->get()], 200);
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string|unique:permissions,name|max:191',
    ], [
      'name.required' => 'Названа не може бути порожньою',
    ]);

    if( $validator->fails() ) {
      return response()->json([
        'status' => 'fail',
        'message' => __('admin.ValidationWentWrong'),
        'errors' => $validator->errors()
      ]);
    }

    Permission::create([
      'name' => $request->name,
    ]);

    return response()->json(['success' => true, 'permission' => Permission::latest()->first(), 'message' => 'Permission created successfully'], 200);
  }

  public function update(Request $request, int $id) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string|unique:permissions,name,' . $id . '|max:100',
    ]);

    if( $validator->fails() ) {
      return response()->json([
        'status' => 'fail',
        'message' => __('admin.ValidationWentWrong'),
        'errors' => $validator->errors()
      ]);
    }

    Permission::find($id)->update([
      'name' => $request->name
    ]);
    return response()->json(['success' => true, 'permission' => Permission::find($id), 'message' => 'Permission updated successfully'], 200);
  }

  public function destroy(int $id) {
    $permission = Permission::find($id);
    if(!$permission) {
      return response()->json([
        'status' => 'error',
        'message' => 'Record not found'
      ]);
    }
    $permission->delete();
    return response()->noContent();
  }

}
