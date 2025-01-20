<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Auth\Events\Registered;

class UsersController extends Controller {

  protected $roles;

  public function __construct() {
    $this->roles = Role::pluck('name','name')->all();
  }

  public function index(Request $request) {
    
    $query = User::latest('created_at')->orderBy('id');//->with('roles');

    if(!empty($request->get('search'))) {
      $query = $query->where('name','like','%' . $request->search . '%');
      $query = $query->orWhere('email','like','%' . $request->search . '%');
      $query = $query->orWhere('phone','like','%' . $request->search . '%');
    }

    $users = $query->paginate(25); //->simplePaginate(25);

    $roles = Role::get();
    $permissions = Permission::get();
    return view('admin.users.index', compact('users','roles','permissions'));

  }

  public function create() {
    $roles = $this->roles;
    return view('admin.users.create', compact('roles'));
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:100',
      'email' => 'required|email|max:100|unique:users,email',
      'password' => 'required|string|min:8|max:100',
      'phone' => 'nullable|string|min:6|max:20|unique:users,phone',
      'roles' => 'required|array'
    ]);

    if(!$validator->passes()) {
      return response()->json([
        'status' => 'fail',
        'message' => 'Validation error',
        'errors' => $validator->errors()
      ]);
    }

    $user = User::create([
      'name' => $request->name,
      'surname' => $request->surname,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'phone' => $request->phone,
      'status' => $request->status == 'on' ? true : false,
      'created_at' => date('Y-m-d H:i:s')
    ]);

    if($user) {

      $user->assignRole($request->roles);

      Session::flash('success', __('admin.UserCreatedSuccessfully'));
      return response()->json([
        'status' => 'success',
        'message' => __('admin.UserCreatedSuccessfully')
      ]);
    } else {
      Session::flash('fail', __('admin.SomethingWentWrong'));
      return response()->json([
        'status' => 'fail',
        'status' => __('admin.SomethingWentWrong')
      ]);
    }
  }

  public function edit(User $user) {
    if(!$user) {
      return redirect('/admin/users')->with('fail', __('admin.UserNotFound'));
    }
    $roles = $this->roles;
    $userRoles = $user->roles->pluck('name','name')->toArray();
    return view('admin.users.edit', compact('roles','user','userRoles'));
  }

  public function update(Request $request, User $user) {

    //$user = User::where('id', Auth::guard('admin')->user()->id)->first();
    //$user = User::find($id);
    if(!$user) {
      //session()->flash('fail', __('admin.UserNotFound'));
      return response()->json([
        'status' => 'fail',
        'message' => __('admin.UserNotFound')
      ]);
    }

    $validatorRules = [
      'name' => 'required|string|max:100',
      'email' => 'required|email|unique:users,email,'. $user->id .',id',
      'phone' => 'nullable|string|min:6|max:20|unique:users,phone,'. $user->id .',id',
      'roles' => 'required|array'
    ];

    if( !empty($request->old_password) ) {
      $validatorRules['old_password'] = 'required';
      $validatorRules['new_password'] = 'required|min:8|max:100';
      $validatorRules['confirm_password'] = 'required|same:new_password';
    }

    $validator = Validator::make($request->all(), $validatorRules);

    if($validator->fails()) {
      return response()->json([
        'status' => 'fail',
        'message' => 'Validation error',
        'errors' => $validator->errors()
      ]);
    }

    $data = [
      'name' => $request->name,
      'surname' => $request->surname,
      'email' => $request->email,
      'phone' => $request->phone,
      'status' => $request->status == 'on' ? true : false,
      'updated_at' => date('Y-m-d H:i:s')
    ];

    if( !empty($request->old_password) ) {
      if( !Hash::check($request->old_password, $user->password) ) {
        //Session::flash('fail', __('admin.YourOldPasswordIsIncorrectPleaseTryAgain'));
        return response()->json([
          'status' => 'fail',
          'status' => __('admin.YourOldPasswordIsIncorrectPleaseTryAgain')
        ]);
      }
      $data['password'] = Hash::make($request->new_password);
    }

    $user->update($data);

    $user->syncRoles($request->roles);

    //Session::flash('success', __('admin.UserHasBeenUpdated'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.UserHasBeenUpdated')
    ]);

  }

  public function destroy(User $user) {
    //$user = User::find($id);
    /* if(!$user) {
      //session()->flash('fail', __('admin.RecordNotFound'));
      return response()->json([
        'status' => 'fail',
        'message' => __('admin.RecordNotFound')
      ]);
    } */
    $user->orders()->delete();
    $user->delete();
    //User::destroy($id);
    //User::where('id', $id)->delete();
    //session()->flash('success', __('admin.UserRemovedSuccessfully'));

    //User::truncate();

    return response()->json([
      'status' => 'success',
      'message' => __('admin.UserRemovedSuccessfully')
    ]);
  }

}
