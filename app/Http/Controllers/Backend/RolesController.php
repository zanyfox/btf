<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolesController extends Controller {

  public function __construct() {
    $this->middleware('auth');
  }

  public function index() {
    $roles = Role::latest()->with('permissions')->get()->toArray();
    return response()->json(['success' => true, 'roles' => $roles], 200);
  }

  public function show($id) {
    $user = User::find($id);
    if (!$user) {
      return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }
    return response()->json(['status' => 'ok', 'user' => $user], 200);
  }

  public function store(Request $request) {

    // Validation
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:2|max:191,unique:roles,name',
      'permissions' => 'nullable|array'
    ], [
      'name.required' => 'Название должно быть заполнено',
    ]);

    if( $validator->fails() ) {
      return response()->json([
        'success' => false,
        'message' => __('admin.ValidationWentWrong'),
        'errors' => $validator->errors()
      ]);
    }

    $role = Role::create([
      'name' => $request->name
    ]);
    if (!$role) {
      return response()->json(['success' => false, 'message' => 'Role not created'], 500);
    }
    if($request->has('permissions')) {
      $role->givePermissionTo($request->permissions);
      //$role->syncPermissions($request->permissions);
    }
    $newRole = Role::with('permissions')->find($role->id);
    return response()->json(['success' => true, 'role' => $newRole], 201);
  }

  // Update user
  public function update(Request $request, $id) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:2|max:191,unique:roles,name,'.$id,
      'permissions' => 'nullable|array'
    ], [
      'name.required' => 'Название должно быть заполнено',
    ]);

    if( $validator->fails() ) {
      return response()->json([
        'success' => false,
        'message' => __('admin.ValidationWentWrong'),
        'errors' => $validator->errors()
      ]);
    }

    $role = Role::find($id);
    if (!$role) {
      return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }

    $role->update([
      'name' => $request->name
    ]);

    if($request->has('permissions')) {
      $role->syncPermissions($request->permissions);
      $role->update(['updated_at' => now()]);
    }

    return response()->json(['status' => 'ok', 'role' => $role], 200);
  }

  public function changeStatus(Request $request, $id) {
    Role::where('id', $id)->update(['status' => $request->status]);
    return response()->json(['success' => true], 200);
  }

  public function destroy($id) {
    $role = Role::find($id);
    if (!$role) {
      return response()->json(['success' => false, 'message' => 'Role not found'], 404);
    }
    $role->delete();
    return response()->noContent();
  }

}
