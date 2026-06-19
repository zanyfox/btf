<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {

  use HasFactory, Notifiable, HasApiTokens, TwoFactorAuthenticatable, HasRoles;

  protected $connection = 'mysql';
  protected $table = 'users';
  protected $primaryKey = 'id';
  public $incrementing = true;
  public $timestamps = true;
  //public $dateFormat = 'Y-m-d H:i:s';

  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'surname',
    'email',
    'password',
    'picture',
    'is_admin',
    'role_id',
    'phone',
    'address',
    'city',
    'region',
    'zip',
    'country',
    'marketingoptin',
    'birthdate',
    'device_key',
    'status'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
    'two_factor_recovery_codes',
    'two_factor_secret'
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  protected $appends = ['full_name','age','formatted_created_at']; // ,'role_names'

  public function getFullNameAttribute() {
    return $this->name . ' ' . $this->surname;
  }

  /* public function getNameAttribute($value) {
    return ucFirst($value);
  }
 */

  // Accessor
  public function getAgeAttribute() {
    if(isset($this->attributes['date_of_birth'])) {
      return Carbon::parse($this->attributes['date_of_birth'])->age;
    } else {
      return null;
    }
  }

  // Mutator
  /* public function setCityAttribute($value) {
    return $this->attributes['city'] = $value . ', Калининградская область';
  } */

  // Relationship With User Posts
  /* public function promotions() {
    return $this->hasMany(Promotion::class, 'author_id')->orderBy('created_at', 'DESC');
  } */

  /* public function roles() {
    return $this->belongsToMany(\Spatie\Permission\Models\Role::class, 'model_has_roles', 'model_id', 'role_id');
  } */

  /* s */

  public function orders() {
    return $this->hasMany(Order::class, 'user_id');
  }

  public function customerAddress() {
    return $this->hasMany(CustomerAddress::class, 'user_id', 'id');
  }

  public function posts() {
    return $this->hasMany(Post::class, 'user_id', 'id');
  }

  public function isAdmin() {
    return ($this->is_admin === 1 || $this->role_id == 2 || $this->hasRole(['admin', 'super-admin'])) ? true : false;
  }

  /* {{ auth()->user()->avatar }} */
  /* public function avatar(): Attribute {
    return Attribute::make(
      get: fn ($value) => asset(Storage::url($value) ?? ''),
    );
  } */

  /* public function getRoleNamesAttribute() {
    return $this->getRoleNames()->toArray(); // Возвращает массив названий ролей
  } */



  public function getFormattedCreatedAtAttribute() {
    return Carbon::parse($this->attributes['created_at'])->format('d.m.Y H:i');
  }
}
