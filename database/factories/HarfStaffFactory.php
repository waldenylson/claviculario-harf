<?php

namespace Database\Factories;

use App\Models\HarfStaff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HarfStaff>
 */
class HarfStaffFactory extends Factory
{
  protected $model = HarfStaff::class;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'name' => $this->faker->name,
      'email' => $this->faker->unique()->safeEmail,
      'phone' => $this->faker->phoneNumber,
      'extension' => $this->faker->optional()->numerify('####'),
      'military' => $this->faker->boolean,
      'electronic_signature' => Hash::make('123456'),
      'department_id' => \App\Models\Department::factory(),
    ];
  }
}
