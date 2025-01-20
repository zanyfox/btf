<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\OrderStatus;

class Order extends Model {
  use HasFactory;
  use SoftDeletes;

  protected $table = 'orders';

  //protected $fillable = ['user_id','currency_id','grand_total','coupon_id'];

  protected $casts = [
    'status' => OrderStatus::class,
    //'created_at' => 'datetime:Y-m-d H:i',
  ];

  protected $appends = ['full_price'];

  public function user() {
    return $this->belongsTo(User::class);
  }

  /* public function customer() {
    return $this->belongsTo(User::class, 'user_id');
  } */

  public function goods() {
    return $this->belongsToMany(Good::class, 'good_order', 'good_id', 'order_id');//->withPivot('quantity')->withTimestamps();
  }

  public function items(): HasMany {
    return $this->hasMany(OrderItem::class, 'order_id', 'id');
  }

  public function coupon() {
    return $this->belongsTo(Coupon::class);
  }

  public function getFullPriceAttribute() {
    $sum = 0;
    foreach ($this->goods as $good) {
      $sum += $good->getPriceForQuantity();
    }
    return $sum;
  }

  public function isAvailable() {
    return !$this->trashed();
  }

  public function currency() {
    return $this->belongsTo(Currency::class);
  }

  /* public function paid_sum() {
    return $this->hasOneThrough(Payment::class, OrderItem::class, CustomerAddress::class, 'user_id', 'customer_address_id', 'id',  'id');
  } */

  /* protected static function booted() {

    static::creating(function ($model) {
      $model->created_by = auth()->user()->id;
    });

    static::updating(function ($model) {
      $model->updated_by = auth()->user()->id;
    });

  } */

}
