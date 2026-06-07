<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\GoodsResource;
use App\Models\Good;

class GoodsController extends Controller {

  public function index() {
    return GoodsResource::collection(Good::paginate());
  }

}
