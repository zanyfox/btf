<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model {
  use HasFactory;

  protected $table = 'galleries';

  protected $fillable = ['name','slug','description','lang','status'];

  public function pictures() {
    return $this->belongsToMany(Picture::class)->orderBy('sort','ASC')->orderBy('id','ASC');
  }
}
