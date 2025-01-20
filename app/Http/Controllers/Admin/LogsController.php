<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;
use Spatie\Activitylog\Models\Activity;

class LogsController extends Controller {

  public function activity() {
    $logs = Activity::all();
    return view('admin.logs.activity', compact('logs'));
  }

  public function orders() {
    $logs = Log::where('type','=','order')->orderBy('id','DESC')->paginate(100);
    return view('admin.logs.orders', compact('logs'));
  }

  public function products($id = null) {
    if($id) {
      $log = Log::where(['id' => $id, 'type' => 'products'])->first();
      $products = isset($log->response) ? json_decode($log->response) : [];
      //print_r($products); die;
      return view('admin.logs.products.show', compact('products'));
    } 
    $logs = Log::whereIn('type',['products'])->paginate(100);
    return view('admin.logs.products.index', compact('logs'));
  }

  public function groups($id = null) {
    if($id) {
      $log = Log::where(['id' => $id, 'type' => 'groups'])->first();
      $groups = isset($log->response) ? json_decode($log->response) : [];
      return view('admin.logs.groups.show', compact('groups'));
    } 
    $logs = Log::whereIn('type',['groups'])->paginate(100);
    return view('admin.logs.groups.index', compact('logs'));
  }
}
