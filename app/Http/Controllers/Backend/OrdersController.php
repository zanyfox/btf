<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Enums\RoleType;

class OrdersController extends Controller {

  public function index(Request $request) {
    $query = Order::latest();
    $query = $query->get()->througn(function ($order) {
      return [
        'id' => $order->id,
        'status' => [
          'name' => $order->status->name,
          'color' => $order->status->color()
        ],
      ];
    })->toArray();
    $orders = $query;
    return response()->json(['status' => 'ok', 'orders' => $orders]);
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
      'name' => 'required|string|min:2|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'phone' => 'required|string|max:255',
      'password' => 'required|string|min:8'//|confirmed',
      //'status' => 'required|boolean',
    ]);

    //return response()->json(['status' => 'ok'], 201);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'password' => bcrypt($request->password),
      //'status' => $request->status,
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
  /* public function changeStatus(Request $request, $id) {
    $user = User::find($id);
    if (!$user) {
      return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }
    $user->update([
      'role_id' => $request->role,
    ]);
    return response()->json(['status' => 'ok', 'user' => $user]);
  } */

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
