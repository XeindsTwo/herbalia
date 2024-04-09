<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
  protected $fillable = [
    'name',
    'email',
    'rating',
    'comment',
    'status',
    'display_on_homepage',
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}