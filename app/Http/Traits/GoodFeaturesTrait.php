<?php

namespace App\Http\Traits;

trait GoodFeaturesTrait {

  public function features($goodId) {
    return DB::select('SELECT * FROM features AS f JOIN feature_good AS fg ON f.id = fg.feature_id WHERE fg.good_id=?', [$goodId]);
  }

}