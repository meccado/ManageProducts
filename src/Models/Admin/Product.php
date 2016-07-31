<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon as Carbon;

class Product extends Model
{
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name', 'description', 'sku', 'price', 'brand_id','published_at', 'published',
  ];

  protected $dates = ['published_at'];

  public function scopePublished($query){
    $query->where('published_at' , '<=', Carbon::now());
  }

  // public function getPublishedAtAttribute($date)
  // {
  //   if (is_null($date))
  //     return null;
  //   else
  //     return Carbon::parse($date)->format('d M Y H:i');
  // }

  public function setPublishedAtAttribute($date)
  {
    //$this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
    $this->attributes['published_at'] = Carbon::parse($date);
  }

  public function categories()
  {
    return $this->belongsToMany(\App\Category::class);
  }

  public function assignBrand(Brand $brand)
  {
    return $this->brands()->save($brand);
  }

  public function assignCategory(Category $category)
  {
    return $this->categories()->save($category);
  }

  public function images()
  {
    return $this->hasMany(\App\ProductImage::class);
  }

  /**
  * Get the brand that owns the product.
  */
  public function brands()
  {
    return $this->belongsToMany(\App\Brand::class);
  }
}
