<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model {
  use HasFactory;
  protected $fillable = ['name','period','period_from','period_to','value_type','value','currency','max_discount','priority','renewal','last_discount','note','active'];
}