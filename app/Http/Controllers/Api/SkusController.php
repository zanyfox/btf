<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Good;

class SkusController extends Controller {

  public function getSkus() {
    $skus = Good::get()->toArray();
    return response()->json($skus);
  }

}
