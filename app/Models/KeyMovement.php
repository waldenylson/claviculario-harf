<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyMovement extends Model
{
  use HasFactory;

  public function key()
  {
    return $this->belongsTo(Key::class);
  }

  public function harfStaff()
  {
    return $this->belongsTo(HarfStaff::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
