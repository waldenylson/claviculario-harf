<?php

namespace Tests\Feature\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\KeyMovement;
use App\Models\Key;
use App\Models\HarfStaff;
use App\Models\User;

class KeyMovementTest extends TestCase
{
  use RefreshDatabase;

  private function createTestKey()
  {
    return Key::factory()->create();
  }

  private function createTestHarfStaff()
  {
    return HarfStaff::factory()->create();
  }

  private function createTestUser()
  {
    return User::factory()->create();
  }

  public function test_index_page_displays_correctly()
  {
    $user = $this->createTestUser();
    $response = $this->actingAs($user)->get(route('key_movements.index'));
    $response->assertStatus(200);
    $response->assertSee('Chaves Movimentadas sem Devolução');
  }

  public function test_create_page_displays_correctly()
  {
    $user = $this->createTestUser();
    $response = $this->actingAs($user)->get(route('key_movements.create'));
    $response->assertStatus(200);
    $response->assertSee('Nova Movimentação de Chave');
  }

  public function test_creates_a_new_key_movement_with_valid_data()
  {
    $key = $this->createTestKey();
    $staff = $this->createTestHarfStaff();
    $user = $this->createTestUser();

    $data = [
      'key_id' => $key->id,
      'efetivo_id' => $staff->id,
      'user_id' => $user->id,
      'movement' => 'some_movement_value',
      'movement_type' => 'Saída',
      'out' => '2025-03-22T11:53:53.892831Z',
      'comments' => 'Teste de movimentação',
      'electronic_signature' => 'some_signature'
    ];

    // Simulate form submission
    $response = $this->actingAs($user)->post(route('key_movements.store'), $data);

    // Assert the response status
    $response->assertStatus(302);

    // Remove the electronic signature from the data before checking the database
    unset($data['electronic_signature']);

    // Assert the database has the new key movement
    $this->assertDatabaseHas('key_movements', $data);
  }

  public function test_edit_page_displays_correctly()
  {
    $user = $this->createTestUser();
    $key = $this->createTestKey();
    $staff = $this->createTestHarfStaff();
    $movement = KeyMovement::factory()->create([
      'key_id' => $key->id,
      'harf_staff_id' => $staff->id,
      'user_id' => $user->id,
      'movement_type' => 'Saída',
      'out' => now(),
    ]);

    $response = $this->actingAs($user)->get(route('key_movements.edit', $movement->id));
    $response->assertStatus(200);
    $response->assertSee('Editar Movimentação de Chave');
  }

  public function test_updates_key_movement_with_valid_data()
  {
    $user = $this->createTestUser();
    $key = $this->createTestKey();
    $staff = $this->createTestHarfStaff();
    $movement = KeyMovement::factory()->create([
      'key_id' => $key->id,
      'harf_staff_id' => $staff->id,
      'user_id' => $user->id,
      'movement_type' => 'Saída',
      'out' => now(),
    ]);

    $data = [
      'movement_type' => 'Retorno',
      'return' => now(),
    ];

    $response = $this->actingAs($user)->put(route('key_movements.update', $movement->id), $data);
    $response->assertStatus(302);
    $this->assertDatabaseHas('key_movements', $data);
  }

  public function test_deletes_existing_key_movement()
  {
    $user = $this->createTestUser();
    $key = $this->createTestKey();
    $staff = $this->createTestHarfStaff();
    $movement = KeyMovement::factory()->create([
      'key_id' => $key->id,
      'harf_staff_id' => $staff->id,
      'user_id' => $user->id,
      'movement_type' => 'Saída',
      'out' => now(),
    ]);

    $response = $this->actingAs($user)->delete(route('key_movements.destroy', $movement->id));
    $response->assertStatus(302);
    $this->assertDatabaseMissing('key_movements', ['id' => $movement->id]);
  }
}
