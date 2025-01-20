<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {

  use HasFactory;

  protected $table = 'order_items';

  protected $fillable = [
    'order_id',
    'good_id',
    'color_id',
    'size_id',
    'name',
    'external_id',
    'quantity',
    'price',
    'total'
  ];
  
  public $timestamps = false;

  public function good(): BelongsTo {
    return $this->belongsTo(Good::class, 'good_id', 'id');
  }

  public function goodColor(): BelongsTo {
    return $this->belongsTo(GoodColor::class, 'color_id', 'id');
  }

}
