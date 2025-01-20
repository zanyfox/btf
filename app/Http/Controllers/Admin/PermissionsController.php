<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Validator;

class PermissionsController extends Controller {

  public function index() {
    $permissions = Permission::get();
    return view('admin.permissions.index', compact('permissions'));
  }

  public function create() {
    return view('admin.permissions.create');
  }

  public function store(Request $request) {

    $request->validate([
      'name' => 'required|string|unique:permissions,name|max:100',
    ]);

    Permission::create([
      'name' => $request->name,
    ]);

    return redirect('/admin/permissions')->with('success', __('admin.PermissionCreatedSuccessfully'));
  }

  public function edit(int $id) {
    $permission = Permission::find($id);
    if(!$permission) {
      return redirect()->route('permissions.index')->with('fail', __('admin.RecordNotFound'));
    }
    return view('admin.permissions.edit', compact('permission'));
  } 

  public function update(Request $request, int $id) {

    $request->validate([
      'name' => 'required|string|unique:permissions,name,' . $id . '|max:100',
    ]);

    Permission::find($id)->update([
      'name' => $request->name
    ]);
    session()->flash('success', __('admin.PermissionHasBeenUpdatedSuccessfully'));
    return redirect()->to('/admin/permissions');
  }   

  public function destroy(int $id) {
    $permission = Permission::find($id);
    if(!$permission) {
      session()->flash('success', __('admin.RecordNotFound'));
      return response()->json([
        'status' => 'error',
        'message' => 'Record not found'
      ]);
    }
    $permission->delete();
    session()->flash('success', __('admin.RecordDeletedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => 'Record deleted successfully'
    ]);
  }

}
