<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\CurrencyConversion;
use App\Http\Traits\Translatable;

class Good extends Model {

  use HasFactory;
  //use SoftDeletes;
  use Translatable;

  protected $table = 'goods';
  protected $primaryKey = 'id';
  public $timestamps = true;
  protected $dateFormat = 'Y-m-d H:i:s';

  protected $fillable = [
    'meta_title',
    'meta_keywords',
    'meta_description',
    'meta_robots',
    'name',
    'slug',
    'subtitle',
    'excerpt',
    'description',
    'custom',
    'related_goods',
    'picture',
    'price',
    'oldprice',
    'discount',
    'order_by',
    'lang',
    'tags',
    'brand_id',
    'sku',
    'barcode',
    'code',
    'external_id',
    'available',
    'track_qty',
    'quantity',
    'type',
    'order_item_type',
    'status',
    'featured',
    'novelty',
    'hit'
  ];

  public function scopeHit($query) {
    return $query->where('hit', 1);
  }

  public function scopeFeatured($query) {
    return $query->where('featured', 'Y');
  }

  public function scopeActive($query) {
    return $query->where('status', 1);
  }

  public function scopeActiveStatus($query) {
    return $query->where('status', 1);
  }
  
  /* public function category() {
    return $this->belongsTo(Category::class);
  } */

  public function categories() {
    return $this->belongsToMany(Category::class, 'category_good');
  }

  public function pictures() {
    return $this->belongsToMany(Picture::class, 'picture_good');
  }

  public function features() {
    //return $this->id;
    //return $this->hasMany(FeatureGood::class, Feature::class, 'good_id', 'id');
    return $this->belongsToMany(Feature::class, 'feature_good');
    //return $this->hasManyThrough(Feature::class, FeatureGood::class, 'good_id', 'id');
  }

  

  public function brand() {
    return $this->belongsTo(Brand::class, 'brand_id');
  }

  public function type() {
    return $this->belongsTo(Type::class, 'type_id');
  }

  /* public function sizes() {
    return $this->hasMany(GoodSize::class, 'good_id','id');
  } */

  public function colors() {
    return $this->hasMany(GoodColors::class, 'good_id', 'id');
  }

  public function getPriceAttribute($value) {
    return round(CurrencyConversion::convert($value), 2);
  }

  /* public function setFeaturedAttribute($value) {
    $this->attributes['featured'] = $value === 'on' ? 'Y' : 'N';
  } */

  public function setNoveltyAttribute($value) {
    $this->attributes['novelty'] = $value === 'on' ? 1 : 0;
  }

  public function setHitAttribute($value) {
    $this->attributes['hit'] = $value === 'on' ? 1 : 0;
  }

  /* public function getPriceForQuantity() {
    if(!is_null($this->pivot)) {
      return $this->price * $this->pivot->quantity;
    }
    return $this->price;
  } */

  public function isHit() {
    return $this->hit == 1;
  }

  public function isNovelty() {
    return $this->novelty == 1;
  }

  public function isRecommend() {
    return $this->featured == 'Y';
  }

  public function isAvailable() {
    return $this->quantity > 0;
  }

  public function modifiers() {
     return $this->hasOne(Modifier::class, 'good_id');
  }

}
