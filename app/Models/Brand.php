<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model {
  use HasFactory;
  protected $table = 'brands';
  protected $fillable = ['name','slug','status'];

  // Accessors
  public function getNameAttribute() {
    return ucfirst($this->attributes['name']);
  }

  // Mutators
  /* public function setNameAttribute($value) {
    $this->attributes['name'] = strtoupper($value);
    $this->attributes['slug'] = Str::slug($value);
  }  */

  public function goods() {
    return $this->hasMany(Good::class);
  }

}
