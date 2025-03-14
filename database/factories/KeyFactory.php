<?php

namespace Database\Factories;

use App\Models\Key;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class KeyFactory extends Factory
{
  protected $model = Key::class;

  public function definition()
  {
    return [
      'department_id' => Department::factory(),
      'number' => $this->faker->randomNumber(3),
      'internal_hallway' => $this->faker->boolean(),
      'eps' => $this->faker->boolean(),
      'epms' => $this->faker->boolean(),
      'comments' => $this->faker->sentence(),
    ];
  }
}
