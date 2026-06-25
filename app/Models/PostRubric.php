<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostRubric extends Model {

  protected $table = 'post_rubrics';

  protected $fillable = [
    'post_id',
    'rubric_id'
  ];



}
