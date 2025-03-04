<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HarfStaff extends Model
{
    use HasFactory;

  protected $guarded = ['_token'];

  protected $table = 'harf_staff';
}
