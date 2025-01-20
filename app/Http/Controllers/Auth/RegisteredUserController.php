<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Jobs\WelcomeEmailJob;

use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class RegisteredUserController extends Controller {

  /**
   * Display the registration view.
   */
  public function create(): View {
    return view('auth.register');
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  /*public function store(Request $request): RedirectResponse {

    $request->validate([
      'name' => ['required','string','min:3','max:100'],
      'email' => ['required','string','email','max:100','unique:'.User::class], // Rule::unique('users', 'email')
      'password' => ['required','confirmed',Rules\Password::defaults()],
    ]);

    $user = User::create([
      'name' => $request->name,
      'surname' => $request->surname,
      'email' => $request->email,
      'password' => Hash::make($request->password), // Hash password
      'phone' => $request->input('phone'),
    ]);

    event(new Registered($user));

    Mail::to($request->email)->send(new WelcomeMail($request->name));

    //auth()->login($user);
    Auth::login($user);

    $request->session()->flash('success', 'User created and logged in');
    return redirect(RouteServiceProvider::HOME);
  }*/

  public function store(Request $request) {

    //$input = $request->input();
    /* $input = $request->except('_token');

    return response()->json([
      'status' => 'test',
      'data' => $input
    ]); */

    /* $request->whenHas('name', function($input) {
      echo 'Data Modify';
    }); */

    /* $request->whenFilled('name', function($input) {
      echo 'Data Modify';
    });
 */

    //$request->flash();
    //$request->flashOnly('name');
    //$request->flashOnly(['name','email']);
    //$request->flashExcept('password');

    //print_r($request->old('name')); die;

    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:3|max:100',
      'phone' => 'nullable|string|min:6|max:20|unique:users',
      'email' => 'required|string|email|max:100|unique:users',
      'password' => 'required|min:6|confirmed'
    ]);

    if(!$validator->passes()) {
      return response()->json([
        'status' => 'fail',
        'errors' => $validator->errors()
      ]);
    }

    $user = User::create([
      'name' => $request->name,
      'phone' => $request->phone,
      'email' => $request->email,
      'password' => Hash::make($request->password)
    ]);

    event(new Registered($user));
    
    session()->flash('success', __('YouHaveBeenRegisterSuccessfully'));

    //$request->session()->flash('success', __('YouHaveBeenRegisterSuccessfully'));

    //Mail::to($request->email)->send(new WelcomeMail($request->name));
    //Mail::to('nozhikmayakovskogo@yandex.ru')->send(new WelcomeMail($request->name));
    WelcomeEmailJob::dispatch($request->name, $request->email)->delay(now()->addSecond(5));

    //return redirect('/login')->withInput();
    //return redirect()->route('/login')->withInput();

    /* return redirect('/login')->withInput(
      $request->except('password')
    ); */

    //Auth::login($user);

    return response()->json([
      'status' => 'success',
      'message' => __('YouHaveBeenRegisterSuccessfully') // __('UserCreatedAndLoggedIn')
    ]);

  }

}
