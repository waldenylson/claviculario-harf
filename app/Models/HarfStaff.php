<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HarfStaff extends Model
{
  use HasFactory;

  protected $table = 'harf_staff';

  protected $guarded = [];

  /**
   * Get the department that the staff belongs to.
   */
  public function department()
  {
    return $this->belongsTo(Department::class);
  }

  public function keyMovements()
  {
    return $this->hasMany(KeyMovement::class);
  }
}
