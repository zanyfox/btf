<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model {

  use HasFactory;

  public $connection = 'mysql';
  public $table = 'posts';
  public $timestamps = true;

  /* protected $fillable = [
    'rubric_id',
    'author_id',
    'keywords',
    'description',
    'title',
    'slug',
    'text',
    'image',
    'tags',
    'lang',
    'status'
  ]; */

  /* public function title(): Attribute {
    return new Attribute(
      get: fn ($value) => ucfirst($value),
      set: fn ($value) => $value
    );
  } */

  /* public function setTitleAttribute($value) {
    $this->attributes['slug'] = $this->uniqiueSlug($value);
  }

  private function uniqiueSlug($title) {
    $slug = Str::slug($title, '-');
    $count = Post::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
    return $count ? "{$slug}-{$count}" : $slug;
  } */

  public function scopeFilter($query, array $filters) {
    if($filters['tag'] ?? false) {
      $query->where('tags', 'like', '%' . $filters['tag'] . '%');
    }
    if($filters['search'] ?? false) {
      $query->where('title', 'like', '%' . $filters['search'] . '%')
        ->orWhere('text', 'like', '%' . request('search') . '%')
        ->orWhere('tags', 'like', '%' . request('search') . '%');
    }
    if($filters['author'] ?? false) {
      $query->where('author_id', '=', $filters['author']);
    }
  }

  public function rubric() {
    return $this->belongsTo(Rubric::class);
  }

  // Relationship To User
  public function author() {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function getRubric() {
    return $this->hasOne('App\Models\Rubric');
  }

  public function getRubrics() {
    return $this->hasMany('App\Models\Rubric');
  }

  public function comments() {
    return $this->hasMany(Comment::class);
  }

  public function getAll($status = true) {
    return DB::table($this->table)
    ->join('rubrics','posts.rubric_id', '=', 'rubrics.id')
    ->where('posts.status', $status)
    ->select('posts.*')
    ->get();
  }

  public function getOne($id) {
    return (array)DB::table($this->table)->find($id);
  }

  public static function getSingle($id) {
    return (array)DB::table(self::table)->find($id);
  }

  public function searchFullText($str) {
    return DB::table($this->table)->whereFullText('text', $str)->get();
  }

  /* public function count() {
    return DB::table($this->table)->count();
  } */

  public function createOne($data) {
    return DB::table($this->table)->insert($data);
  }

  public function updateOne($id, $data) {
    return DB::table($this->table)->where('id',$id)->update($data);
  }

  public function deleteOne($id) {
    return DB::table($this->table)->where('id',$id)->delete();
  }

  public function getAvg($field) {
    return DB::table($this->table)->avg($field);
  }

  public function getSum($field) {
    return DB::table($this->table)->sum($field);
  }

  public function getMax($field) {
    return DB::table($this->table)->max($field);
  }

  public function getMin($field) {
    return DB::table($this->table)->min($field);
  }

}
