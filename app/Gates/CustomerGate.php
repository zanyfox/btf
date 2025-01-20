<?php

namespace App\Gates;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerGate {
  use HandlesAuthorization;

  public function isCustomer(User $user) {
    return $user->is_customer;
  }
}