<?php

namespace App\Http\Traits;

trait ActiveStatusTrait {

  public function scopeActiveStatus($query) {
    return $query->where('status', 1);
  }

  public function scopeOrderByColumn($query, $column, $dir = 'DESC') {
    return $query->orderBy($column,  $dir);
  }

}