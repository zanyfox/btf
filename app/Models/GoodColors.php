<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodColors extends Model {

  use HasFactory;

  protected $table = 'good_colors';
  protected $fillable = ['good_id','color_id','quantity','price'];
  public $timestamps = false;

  public function color() {
    return $this->belongsTo(Color::class, 'color_id', 'id');
  }


}
