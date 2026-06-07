<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\WhereSlugTrait;

class Page extends Model {
  use WhereSlugTrait;

  protected $fillable = [
    'keywords',
    'description',
    'title',
    'slug',
    'subtitle',
    'text',
    'lang',
    'parent_id',
    'status'
  ];

}
