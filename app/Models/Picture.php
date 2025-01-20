<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model {
  use HasFactory;

  protected $table = 'pictures';
  protected $fillable = ['path','name','alt','description','link','sort'];

  public function galleries() {
    return $this->belongsToMany(Gallery::class);
  }

}
