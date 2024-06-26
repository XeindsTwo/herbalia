<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
  protected $fillable = [
    'name',
    'subtitle',
  ];

  public function products(): HasMany
  {
    return $this->hasMany(Product::class);
  }
}