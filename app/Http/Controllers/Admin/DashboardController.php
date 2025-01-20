<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Page;
use App\Models\Post;
use App\Models\Rubric;
use App\Models\Good;
use App\Models\Brand;
use App\Models\Review;
use App\Models\Log;
use App\Models\Category;
use App\Models\User;
use App\Models\Role;

class DashboardController extends Controller {

  public function index() {

    $admin = Auth::guard('admin')->user();
    //dd($admin);
    $totalRevenue = Order::where('status','!=', 'cancelled')->sum('grand_total');

    $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
    $currentDate = Carbon::now()->format('Y-m-d');

    $revenueCurrentMonth = Order::where('status','!=','cancelled')
      ->whereDate('created_at','>=',$startOfMonth)
      ->whereDate('created_at','<=',$currentDate)
      ->sum('grand_total');
    

    $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
    $lastMonthStartDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');

    $revenueLastMonth = Order::where('status','!=','cancelled')
      ->whereDate('created_at','>=',$startOfLastMonth)
      ->whereDate('created_at','<=',$lastMonthStartDate)
      ->sum('grand_total');

    $startOfLastThirtyDays = Carbon::now()->subDays(30)->format('Y-m-d');

    $revenueLastThirtydays = Order::where('status','!=','cancelled')
      ->whereDate('created_at','>=',$startOfLastThirtyDays)
      ->whereDate('created_at','<=',$currentDate)
      ->sum('grand_total');

    $stopListGoods = Good::where('available',true)->take(20)->get();
    $reviews = Review::all();
    $logs = Log::take(10)->latest()->get();

    return view('admin.dashboard', [
      'ordersCount' => Order::where('status','!=','cancelled')->count(),
      'todayOrders' => Order::whereDate('created_at', $currentDate)->count(),
      'thisMonthOrders' => Order::whereMonth('created_at', Carbon::now()->format('m'))->count(),
      'thisYearOrders' => Order::whereYear('created_at', Carbon::now()->format('y'))->count(),
      'totalRevenue' => $totalRevenue,
      'revenueCurrentMonth' => $revenueCurrentMonth,
      'revenueLastMonth' => $revenueLastMonth,
      'revenueLastThirtydays' => $revenueLastThirtydays,
      'customersCount' => User::where('is_admin','!=',true)->count(),
      'pagesCount' => Page::count(),
      'postsCount' => Post::count(),
      //'rubricsCount' => Rubric::count(),
      'totalGoods' => Good::count(),
      'totalCategories' => Category::count(),
      'totalBrands' => Brand::count(),
      'usersCount' => User::count(),
      //'rolesCount' => Role::count(),
      'stopListGoods' => $stopListGoods,
      'reviews' => $reviews,
      'logs' => $logs,
    ]);
  }

  public function clearCache() {
    Cache::flush();
    //Cache::forget('key');
    session()->flash('success', 'Очистка кэша выполнена');
    return redirect()->back();
  }

  public function storageLink() {
    Artisan::call('storage:link');
    session()->flash('success', 'Пути к картинкам успешно переопределены');
    return redirect()->back();
  }

  public function seedGoods() {
    Artisan::call('db:seed --class=GoodSeeder');
    session()->flash('success', 'Товары успешно добавлены/обновлены');
    return redirect()->back();
  }

}
