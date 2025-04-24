<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use Hamcrest\Core\Set;

class SettingsController extends Controller {

  public function index() {
    $settings = Setting::all();
    return response()->json(['status' => 'ok', 'settings' => $settings], 200);
  }

  public function show($id) {
    $user = User::find($id);
    if (!$user) {
      return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }
    return response()->json(['status' => 'ok', 'user' => $user], 200);
  }

  public function store(Request $request) {
    $setting = Setting::create([
      'name' => $request->name,
      'key' => $request->key,
      'value' => $request->value,
      'lang' => $request->lang,
      'status' => $request->status,
    ]);
    return response()->json(['status' => 'ok', 'setting' => $setting], 201);
  }

  // Update user
  public function update(Request $request, $id) {

    $setting = Setting::find($id);
    if (!$setting) {
      return response()->json(['status' => 'error', 'message' => 'Setting not found'], 404);
    }
    $setting->update([
      'name' => $request->name,
      'key' => $request->key,
      'value' => $request->value,
      'lang' => $request->lang,
      'status' => $request->status
    ]);
    return response()->json(['status' => 'ok', 'setting' => $setting], 200);
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
