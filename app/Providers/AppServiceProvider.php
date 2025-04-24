<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use App\Models\Good;
use App\Models\Order;
use App\Observers\GoodObserver;
use App\Observers\OrderObserver;


class AppServiceProvider extends ServiceProvider {
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register() {
    Schema::defaultStringLength(191);
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot() {

    //\URL::forceScheme('https');

    Model::unguard();

    Paginator::useBootstrapFive();

    Blade::directive('datetime', function ($expression) {
        return "<?php echo ($expression)->format('d.m.Y H:i'); ?>";
    });

    View::share('your_ip', '192.168.0.102');
    view()->share('your_location', 'Kaliningrad, Russia');

    /* $settings = Cache::remember('settings', now()->addDays(30), function () {
      return Setting::all()->pluck('value','key')->toArray();
    });
    view()->share('settings', $settings); */

    // Fetch Popular Goods
    /* $popularGoods = Order::get()->map->goods->flatten()->map->pivot->mapToGroups(function($pivot) {
      return [$pivot->good_id => $pivot->quantity];
    })->map->sum()->sort()->take(3)->keys()->all()->toArray();
    view()->share('popularGoods', $popularGoods); */

    // Detect Good updates
    Good::observe(GoodObserver::class);

    // Detect change Order status
    Order::observe(OrderObserver::class);

  }
}
