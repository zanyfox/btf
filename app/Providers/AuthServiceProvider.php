<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
  /**
   * The model to policy mappings for the application.
   *
   * @var array<class-string, class-string>
   */
  protected $policies = [
    // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    \App\Models\Category::class => \App\Policies\CategoryPolicy::class
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot() {
    $this->registerPolicies();

    Gate::define('isCustomer', [\App\Gates\CustomerGate::class, 'isCustomer']);

    /* Gate::define('isNotCustomer', function (User $user) {
      return !$user->is_customer;
    }); */

    Gate::define('isAdmin', function (User $user) {
      return $user->is_admin;
    });

  }
}
