<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
  protected $guarded = ['id'];
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name', 'description', 'parent_id', 'sort_order',
  ];
  public function products()
  {
    return $this->belongsToMany(\App\Product::class);
  }
  public function parent()
  {
    return $this->belongsTo('App\Category', 'parent_id');
  }
  public function children()
  {
    return $this->hasMany('App\Category', 'parent_id');
  }
}
