<?php

namespace Tests\Feature\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\KeyMovement;
use App\Models\Key;
use App\Models\HarfStaff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
    $response->assertSee('Movimentações de Chaves');
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
    $user = User::factory()->create();
    $efetivo = HarfStaff::factory()->create();
    $key = Key::factory()->create();

    $data = [
      'key_id' => $key->id,
      'efetivo_id' => $efetivo->id,
      'user_id' => $user->id,
      'movement' => 'some_movement_value',
      'movement_type' => 'Saída',
      'out' => now(),
      'comments' => 'Teste de movimentação',
      'electronic_signature' => 'valid_signature', // Assinatura válida para o teste
    ];

    // Simular a assinatura eletrônica válida
    $efetivo->electronic_signature = Hash::make('valid_signature');
    $result = $efetivo->save();

    dd($result);

    $response = $this->actingAs($user)->post(route('key_movements.store'), $data);
    $response->assertStatus(302);

    // Remover a assinatura eletrônica dos dados antes de verificar no banco de dados
    unset($data['electronic_signature']);

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
