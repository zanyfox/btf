<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller {

  public function index() {
    $roles = Role::get();
    return view('admin.roles.index',compact('roles'));
  }

  public function create() {
    return view('admin.roles.create');
  }

  public function store(Request $request) {
    $request->validate([
      'name' => [
        'required',
        'string',
        'max:255',
        'unique:roles'
      ],
    ]);

    Role::create([
      'name' => $request->name,
    ]);

    return redirect('/admin/roles')->with('success', __('admin.RoleCreatedSuccessfully'));
  }

  public function edit(Role $role) {
    return view('admin.roles.edit',compact('role'));
  }

  public function update(Request $request, Role $role) {

    $request->validate([
      'name' => [
        'required',
        'string',
        'max:255',
        'unique:roles,name,' . $role->id
      ],
    ]);

    $role->update([
      'name' => $request->name
    ]);
    
    return redirect('/admin/roles')->with('success', __('admin.RoleHasBeenUpdatedSuccessfully'));

  }

  public function destroy(Role $role) {
    $role->delete();
    return response()->json(['status' => 'success', 'message' => __('admin.RoleDeletedSuccessfully')]);
  }

  /**
   * Add permissions to a role
   */
  public function givePermissions(Request $request, int $id) {

    $role = Role::findOrFail($id);

    if($request->isMethod('put')) {
      $request->validate([
        'permissions' => 'required|array'
      ]);
      $role->syncPermissions($request->permissions);
      return redirect()->back()->with('success', __('admin.PermissionsAddedSuccessfully'));
    }

    $permissions = Permission::get();
    $rolePermissions = $role->permissions->pluck('id')->toArray();
    return view('admin.roles.add-permissions',compact('role','permissions','rolePermissions'));
  }

}
