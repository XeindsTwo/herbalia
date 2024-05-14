<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
  protected $fillable = [
    'name',
    'price',
    'article',
    'category_id'
  ];

  protected static function boot(): void
  {
    parent::boot();

    static::deleting(function ($product) {
      $product->images()->delete();
    });
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  public function images(): HasMany
  {
    return $this->hasMany(ProductImage::class);
  }

  public function composition(): HasMany
  {
    return $this->hasMany(ProductComposition::class);
  }

  public function carts(): HasMany
  {
    return $this->hasMany(Cart::class);
  }
}