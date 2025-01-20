<?php

namespace App\Observers;

use Illuminate\Support\Facades\Log;
use App\Models\Good;

class GoodObserver {
  
  public function updating(Good $good) {
    $oldQuantity = $good->getOriginal('quantity');
    if( $oldQuantity == 0 && $good->quantity > 0 ) {
      //dd($oldQuantity);
    }
    Log::info($oldQuantity);
  }

}
