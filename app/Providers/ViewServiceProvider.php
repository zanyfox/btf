<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

use App\Models\Setting;

class ViewServiceProvider extends ServiceProvider {
  /**
   * Register services.
   *
   * @return void
   */
  public function register() {
    //
    
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot() {
    //

    // view()->share('your_ip', '192.168.0.102');
    // view()->share('your_location', 'Kaliningrad, Russia');

    View::composer('*', function ($view) {
      $settings = Cache::remember('settings', now()->addDays(30), function () {
        return Setting::all()->pluck('value','key')->toArray();
      });
      $view->with('settings', $settings);
    });
    View::composer(['partials.footer'], \App\ViewComposers\LinksComposer::class);
    View::composer('*', \App\ViewComposers\CurrenciesComposer::class);
  }
}
