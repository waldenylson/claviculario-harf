<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
  use HasFactory;

  protected $guarded = [];

  public function department()
  {
    return $this->belongsTo(Department::class);
  }

  public function keyMovements()
  {
    return $this->hasMany(KeyMovement::class);
  }
}
