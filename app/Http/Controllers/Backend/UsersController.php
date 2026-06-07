<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller {

  public function __construct() {
    $this->middleware('auth:web');

    // Check if user is admin
    $this->middleware('can:isAdmin')->only(['index', 'show', 'store', 'update', 'changeStatus', 'changeRole', 'destroy']);
  }

  public function index(Request $request) {

    $this->authorize('isAdmin', User::class);



    $query = User::latest('created_at')->orderBy('id')
      //->with('roles')
      ->select('id','name','surname','email','phone', 'picture', 'birthdate','created_at','birthdate','status');
    //$query = $query->roles();


    //$searchQuery = $request->get('search');
    /* if(!empty($request->search)) {
      $query = $query->where('name','like','%' . $request->search . '%');
      $query = $query->orWhere('email','like','%' . $request->search . '%');
      $query = $query->orWhere('phone','like','%' . $request->search . '%');
    } */
    $query = $query->when(request('search'), function ($query, $search) {
      return $query->where(function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%')
          ->orWhere('email', 'like', '%' . $search . '%')
          ->orWhere('phone', 'like', '%' . $search . '%');
      });
    });



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

    $users = $query->paginate(10);
    return response()->json([
      'success' => true,
      'users' => $users,
    ], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
  }

  public function show($id) {

    // Check if user is admin
    //$this->authorize('isAdmin', User::class);

    if( \Gate::allows('isAdmin') || \Gate::allows('isAuthor') ) {
      $user = User::find($id);
      if (!$user) {
        return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
      }
      return response()->json(['status' => 'ok', 'user' => $user], 200);
    }
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:2|max:191',
      'surname' => 'nullable|string|min:2|max:191',
      'email' => 'bail|required|email|max:191|unique:users',
      'phone' => 'nullable|string|max:30',
      //'picture' => 'required|mime:jpeg,png,jpg,gif,svg|max:2048',
      //'password' => 'required|string|min:8',
      //'status' => 'required|boolean',
    ], [
      //'name.required' => 'Name is required',
      //'email.required' => 'Email is required',
      //'email.unique' => 'Email is already taken',
      //'password.required' => 'Password is required',
      //'password.min' => 'Password must be at least 8 characters',
    ]);

    if( $validator->fails() ) {
      return response()->json([
        'status' => 'fail',
        'message' => __('admin.ValidationWentWrong'),
        'errors' => $validator->errors()
      ]);
    }

    $user = User::create([
      'name' => $request->name,
      'surname' => $request->surname,
      'email' => $request->email,
      'phone' => $request->phone,
      'picture' => $request->picture,
      'password' => Hash::make($request->password), //bcrypt($request->password),
      'status' => (bool)$request->status,
    ]);
    if (!$user) {
      return response()->json(['status' => 'error', 'message' => 'User not created'], 500);
    }
    return response()->json(['success' => true, 'user' => $user], 201);
  }

  // Update user
  public function update(Request $request, $id) {

    $user = User::findOrFail($id);

    $this->validate($request, [
      'name' => 'required|string|max:191',
      'email' => 'bail|required|string|email|max:191|unique:users,email,' . $user->id,
      //'phone' => 'required|string|max:191',
      'password' => 'sometimes|min:8',
      //'status' => 'required|boolean',
    ]);



    $userData = [
      'name' => $request->name,
      'surname' => $request->surname,
      'email' => $request->email,
      'phone' => $request->phone,
      //'status' => $request->status,
    ];

    if($request->password) {
      $userData['password'] = Hash::make($request->password); // bcrypt($request->password);
    }

    $user->update($userData);
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

    // Check if user is admin
    $this->authorize('isAdmin', User::class);

    $user = User::findOrFail($id);
    $user->delete();
    return response()->noContent();
  }

  public function bulkBan(Request $request) {

    // Check if user is admin
    $this->authorize('isAdmin', User::class);

    $result = User::whereIn('id', $request->ids)->update(['status' => false]);
    if (!$result) {
      return response()->json(['status' => 'fail', 'message' => 'Selected users not banned']);
    }
    return response()->noContent();
  }

  public function bulkUnban(Request $request) {

    // Check if user is admin
    $this->authorize('isAdmin', User::class);


    $result = User::whereIn('id', $request->ids)->update(['status' => true]);
    if (!$result) {
      return response()->json(['status' => 'fail', 'message' => 'Selected users not unbanned']);
    }
    return response()->noContent();
  }

  public function getUserById($id) {

    // Check if user is admin
    $this->authorize('isAdmin', User::class);

    $user = User::find($id);
    if ($user) {
      return response()->json(['status' => 'ok', 'user' => $user], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
    } else {
      return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }
  }

}
