<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Key extends Model
{
    use HasFactory;

    public function department(): HasOne
    {
        return $this->hasOne(Department::class);
    }
}
