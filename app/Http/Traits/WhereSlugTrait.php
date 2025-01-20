<?php

namespace App\Http\Traits;

trait WhereSlugTrait {

  public function scopeWhereSlug($query, $value) {
    return $query->where('slug', $value)->first();
  }

}