<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasFactory, HasApiTokens;

  protected $fillable = [
    'login',
    'name',
    'email',
    'password',
    'role',
  ];

  public function reviews(): HasMany
  {
    return $this->hasMany(Review::class);
  }

  public function cartItems(): HasMany
  {
    return $this->hasMany(Cart::class);
  }

  public function orders(): HasMany
  {
    return $this->hasMany(Order::class);
  }
}