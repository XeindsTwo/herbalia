<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Improvement extends Model
{
  protected $fillable = [
    'name',
    'email',
    'suggestion_comment'
  ];
}