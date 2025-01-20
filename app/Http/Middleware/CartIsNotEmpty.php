<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CartIsNotEmpty {

  
  public function handle(Request $request, Closure $next) {
    // TODO
    $orderId = session('orderId');
    if(!is_null($orderId)) {
      $order = Order::findOrFail($orderId);
      if($order->items->count() == 0) {
        return $next($request);
      }
    }
    session()->flash('warning', 'Your Cart is empty');
    return redirect()->route('home');
  }
}
