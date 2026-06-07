<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Order;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Enums\RoleType;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class StatsController extends Controller {

  public function orders() {

    $ordersCount = [
      /* 'total' => Order::count(),
      'pending' => Order::where('status', 'pending')->count(),
      'processing' => Order::where('status', 'processing')->count(),
      'completed' => Order::where('status', 'completed')->count(),
      'cancelled' => Order::where('status', 'cancelled')->count(),
      'delivered' => Order::where('status', 'delivered')->count(),
      'failed' => Order::where('status', 'failed')->count(),
      'refunded' => Order::where('status', 'refunded')->count(),
      'shipped' => Order::where('status', 'shipped')->count(),
      'unshipped' => Order::where('status', 'unshipped')->count(),
      'partially_shipped' => Order::where('status', 'partially_shipped')->count(),
      'partially_delivered' => Order::where('status', 'partially_delivered')->count(), */
      'todayCount' => 13, // Order::whereDate('created_at', date('Y-m-d'))->count(),
      'todayTotal' => 13 * 180, // Order::whereDate('created_at', date('Y-m-d'))->sum('grand_total'),
      'yesterdayTotal' => 11 * 180, // Order::whereDate('created_at', date('Y-m-d', strtotime('-1 day')))->sum('grand_total'),
      'thisMonthCount' => 392, // Order::whereMonth('created_at', date('m'))->count(),
      'thisMonthTotal' => 180 * 392, // Order::whereMonth('created_at', date('m'))->sum('grand_total'),
      'lastMonthTotal' => 256 * 392, // Order::whereMonth('created_at', date('m', strtotime('-1 month')))->sum('grand_total'),
      'thisYearCount' => 4724, // Order::whereYear('created_at', date('Y'))->count(),
      'thisYearTotal' =>  180 * 4724, // Order::whereYear('created_at', date('Y'))->sum('grand_total'),
      'lastYearTotal' => 120 * 4724, // Order::whereYear('created_at', date('Y', strtotime('-1 year')))->sum('grand_total'),
    ];

    return response()->json([
      'success' => true,
      'orders' => $ordersCount
    ], 200);

  }

  public function customers() {

    $customers = [
      'totalCount' => User::count(),
      //'maleCount' => User::where('gender', 'male')->count(),
      //'femaleCount' => User::where('gender', 'female')->count(),
      'recent' => User::whereMonth('created_at', date('m'))->limit(5)->get(),
    ];



    return response()->json([
      'success' => true,
      'customers' => $customers
    ], 200);

  }

}
