<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Psy\debug;

class Key extends Model
{
  use HasFactory;

  protected $table = 'keys';

  protected $guarded = [];

  protected $fillable = [
    'department_id',
  ];

  // Adicione a lógica para determinar se a chave está retirada
  public function getIsCheckedOutAttribute()
  {
    // Supondo que você tenha uma relação com KeyMovement
    return $this->movements()->whereNull('return')->exists();
  }

  public function department()
  {
    return $this->belongsTo(Department::class);
  }

  public function keyMovements()
  {
    return $this->hasMany(KeyMovement::class);
  }

  public function movements()
  {
    return $this->hasMany(KeyMovement::class);
  }
}
