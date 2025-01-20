<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modifier extends Model {
  use HasFactory;
  protected $table = 'modifiers';
  public $timestamps = false;

}
