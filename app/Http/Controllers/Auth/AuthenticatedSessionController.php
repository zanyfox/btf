<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSessionController extends Controller {
  /**
   * Display the login view.
   */
  public function create(): View {
    return view('auth.login');
  }

  /**
   * Handle an incoming authentication request.
   */
  public function store(LoginRequest $request): RedirectResponse {
    $request->authenticate();
    $request->session()->regenerate();

    /* if( session()->has('url.intended') ) {
      return redirect(session()->get('url.intended'));
    } */

    //return redirect()->intended(RouteServiceProvider::ACCOUNT);
    return redirect()->intended(RouteServiceProvider::HOME);
  }

  /* public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required'
    ]);

    if(!$validator->passes()) {
      return redirect()->route('login')->withErrors($validator)->withInput($request->only('email'));
    }

    if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
      return redirect()->route('account.index');
    } else {
      return redirect()->route('login')
        ->withInput($request->only('email'))
        ->with('fail', 'Either email/password is incorrect');
    }
  } */

  /**
   * Destroy an authenticated session.
   */
  public function destroy(Request $request): RedirectResponse {
    //auth()->logout();
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
  }
}
