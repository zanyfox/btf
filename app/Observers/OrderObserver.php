<?php

namespace App\Observers;

use Illuminate\Support\Facades\Log;
use App\Models\Order;

class OrderObserver {

  public function updating(Order $order) {
    $oldStatus = $order->getOriginal('status');
    Log::channel('order')->info('Статус заказа №' . $order->id . ' изменился с ' . $oldStatus->value . ' на ' . $order->status->value);
  }

}
