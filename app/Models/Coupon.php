<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model {
  use HasFactory;

  protected $fillable = [
    'code',
    'name',
    'description',
    'type',
    'value',
    'currency_id',
    'only_once',
    'min_sum',
    'status',
    'started_at',
    'expired_at'
  ];

  public function orders() {
    return $this->hasMany(Order::class);
  }

  public function currency() {
    return $this->belongsTo(Currency::class);
  }

}
