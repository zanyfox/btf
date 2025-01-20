<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model {

  use HasFactory;
  protected $table = 'wishlists';
  protected $primaryKey = 'id';
  protected $fillable = ['user_id','good_id'];
  public $timestamps = false;

  public function good(): BelongsTo {
    return $this->belongsTo(Good::class, 'good_id', 'id');
  }

}
