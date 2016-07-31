<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
  protected $fillable = ['product_id', 'file_name', 'file_size', 'file_mime', 'file_path', 'created_by'];


  public function product()
  {
    return $this->belongsTo(\App\Product::class);
  }
}
