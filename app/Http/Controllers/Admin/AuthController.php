<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class AuthController extends Controller {

  public function login() {
    return view('admin.auth.login');
  }

  public function authenticate(Request $request) {

    // Form Validation
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required|string'
    ]);

    // If the form is not valid
    if( !$validator->passes() ) {
      return redirect()->route('admin.login')->withErrors($validator)->withInput($request->only('email'));
    }

    if( Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')) ) {
      $admin = Auth::guard('admin')->user();
      if( $admin->role_id != 2 ) {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('fail',__('admin.YouAreNotAuthorizedToAccessAdminPanel'));
      }
      return redirect()->route('admin.dashboard');
    }
    return redirect()->route('admin.login')->with('fail',__('admin.EitherEmailPasswordIsIncorrect'));

  }

  public function logout() {
    Auth::guard('admin')->logout();
    return redirect()->route('admin.login');
  }

}
