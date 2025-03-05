<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
  protected $table = 'departments';

  use HasFactory;

  /**
   * Get the staff members for the department.
   */
  public function harfStaff()
  {
    return $this->hasMany(HarfStaff::class);
  }
}
