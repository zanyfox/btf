<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Enums\RoleType;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\search;

class UsersController extends Controller {

  public function index(Request $request) {

    $query = User::latest('created_at')->orderBy('id')->select('id','name','email','phone','created_at','role_id','status');
    $query = $query->with('roles');

    //$searchQuery = $request->get('search');
    if(!empty($request->search)) {
      $query = $query->where('name','like','%' . $request->search . '%');
      $query = $query->orWhere('email','like','%' . $request->search . '%');
      $query = $query->orWhere('phone','like','%' . $request->search . '%');
    }

    /* $users = $query->paginate(2)->map(function ($user) {
      return [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'phone' => $user->phone,
        'created_at' => $user->created_at, // $user->formatted_created_at // $user->created_at->format(config('app.datetime_format')),
        'role' => RoleType::from($user->role_id)->name,
        'status' => $user->status,
        'roles' => $user->roles->pluck('name'),
      ];
    })->toArray(); */

    $users = $query->paginate(2);

    $roles = Role::get();
    $permissions = Permission::get();
    return response()->json([
      'status' => 'ok',
      'users' => $users,
      'roles' => $roles,
      'permissions' => $permissions,
    ], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
  }

  public function show($id) {
    $user = User::find($id);
    if (!$user) {
      return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }
    return response()->json(['status' => 'ok', 'user' => $user], 200);
  }

  public function store(Request $request) {

    request()->validate([
      'name' => 'required|string|min:2|max:191',
      'email' => 'required|string|email|max:191|unique:users',
      'phone' => 'string|max:30',
      'password' => 'required|string|min:8',//|confirmed',
      'status' => 'required|boolean',
    ]);

    $this->validate($request, [
      'name' => 'required|string|min:2|max:191',
      'email' => 'required|string|email|max:191|unique:users',
      'phone' => 'string|max:30',
      'password' => 'required|string|min:8',//|confirmed',
      'status' => 'required|boolean',
    ]);

    //return response()->json(['status' => 'ok'], 201);

    $user = User::create([
      'name' => $request->name,
      'surname' => $request->surname,
      'email' => $request->email,
      'phone' => $request->phone,
      'picture' => $request->picture,
      'password' => Hash::make($request->password),
      'status' => (bool)$request->status,
    ]);
    if (!$user) {
      return response()->json(['status' => 'error', 'message' => 'User not created'], 500);
    }
    return response()->json(['status' => 'ok', 'user' => $user], 201);
  }

  // Update user
  public function update(Request $request, $id) {

    request()->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email,' . $id,
      'phone' => 'required|string|max:255',
      'password' => 'sometimes|string|min:8'//|confirmed',
      //'status' => 'required|boolean',
    ]);

    $user = User::find($id);
    if (!$user) {
      return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }
    $user->update([
      'name' => request('name'),
      'email' => $request->email,
      'phone' => $request->phone,
      'password' => $request->password ? bcrypt($request->password) : $user->password,
      //'status' => $request->status,
    ]);
    return response()->json(['status' => 'ok', 'user' => $user]);
  }

  // Change user status
  public function changeStatus(Request $request, $id) {
    $user = User::find($id);
    if (!$user) {
      return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }
    $user->update([
      'status' => $request->status,
    ]);
    return response()->json(['status' => 'ok', 'user' => $user]);
  }

  // Change user role
  public function changeRole(Request $request, $id) {

    $user = User::find($id);
    if (!$user) {
      return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }
    $user->update([
      'role_id' => $request->role,
    ]);
    return response()->json(['status' => 'ok', 'user' => $user]);
  }

  public function destroy($id) {
    $user = User::find($id);
    if (!$user) {
      return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }
    $user->delete();
    return response()->json(['status' => 'ok', 'message' => 'User deleted'], 200);
  }

  public function getUserById($id) {
    $user = User::find($id);
    if ($user) {
      return response()->json(['status' => 'ok', 'user' => $user], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
    } else {
      return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }
  }

}
