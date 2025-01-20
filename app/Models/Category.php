<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ActiveStatusTrait;
use App\Http\Traits\Translatable;

class Category extends Model {
  
  use ActiveStatusTrait;
  use Translatable;

  protected $table = 'categories';

  public function parent() {
    return $this->belongsTo(Category::class, 'parent_id');
  }

  public function children() {
    return $this->hasMany(Category::class, 'parent_id');
  }

  public function goods() {
    //return $this->hasMany(Good::class);
    return $this->belongsToMany(Good::class, 'category_good');
  }

  public function color() {
    return $this->belongsTo(Color::class);
  }

}
