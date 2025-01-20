<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubric extends Model {
  use HasFactory;

  protected $table = 'rubrics';
  protected $primaryKey = 'id';

  protected $fillable = ['name','slug','lang','status'];

  protected $casts = [
    'status' => 'boolean'
  ];

  protected $appends = [
    'keywords',
    'description'
  ];

  public function getKeywordsAttribute() {
    return $this->name;
  }

  public function getDescriptionAttribute() {
    return $this->name;
  }

  protected $hidden = [
    'updated_at'
  ];

  public function posts() {
    return $this->hasMany(Post::class, 'rubric_id');
  }

}
