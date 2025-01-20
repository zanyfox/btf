<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model {
  use HasFactory;

  public $connection = 'mysql';
  public $table = 'slides';
  public $timestamps = false;

  public function picture() {
    return $this->hasOne(Picture::class, 'id');
  }

}
