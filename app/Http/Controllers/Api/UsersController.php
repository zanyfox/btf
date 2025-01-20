<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller {
  
  public function index() {
    $users = User::latest()->get();
    return $users;
  }

  public function store() {
    $user = User::create([
      'name' => request('name'),
      'email' => request('email'),
      'password' => bcrypt(request('password'))
    ]);
    return $user;
  }

}
