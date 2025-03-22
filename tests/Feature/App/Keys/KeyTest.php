<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Key;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KeyTest extends TestCase
{
  use RefreshDatabase;

  private function createTestUser(): User
  {
    return User::factory()->create();
  }

  private function createTestDepartment(): Department
  {
    return Department::factory()->create();
  }

  private function createTestKey(): Key
  {
    return Key::factory()->create();
  }

  public function test_index_page_displays_correctly()
  {
    $user = $this->createTestUser();

    $response = $this->actingAs($user)->get(route('keys.index'));
    $response->assertStatus(200);
    $response->assertSee('Listagem de Chaves');
  }

  public function test_create_page_displays_correctly()
  {
    $user = $this->createTestUser();
    $response = $this->actingAs($user)->get(route('keys.create'));
    $response->assertStatus(200);
    $response->assertSee('Cadastrar Nova Chave');
  }

  public function test_store_key_with_valid_data()
  {
    $user = $this->createTestUser();
    $department = $this->createTestDepartment();

    $data = [
      'department_id' => $department->id,
      'number' => 123,
      'internal_hallway' => 1,
      'reserved ' => 0,
      'eps' => 1,
      'epms' => 1,
      'comments' => 'Test comment',
    ];

    $response = $this->actingAs($user)->post(route('keys.store'), $data);

    dd($response);
    // Verifica se houve redirecionamento (status 302)
    $response->assertStatus(302);
    $this->assertDatabaseHas('keys', $data);
  }

  public function test_edit_page_displays_correctly()
  {
    $user = $this->createTestUser();
    $key = $this->createTestKey();

    $response = $this->actingAs($user)->get(route('keys.edit', $key->id));
    $response->assertStatus(200);
    $response->assertSee('Editar Chave Cadastrada');
  }

  public function test_update_key_with_valid_data()
  {
    $user = $this->createTestUser();
    $key = $this->createTestKey();
    $department = $this->createTestDepartment();

    $data = [
      'department_id' => $department->id,
      'number' => 123,
      'internal_hallway' => 1,
      'reserved ' => 0,
      'eps' => 1,
      'epms' => 1,
      'comments' => 'Test comment',
    ];

    $response = $this->actingAs($user)->put(route('keys.update', $key->id), $data);
    // Verifica se houve redirecionamento (status 302)
    $response->assertStatus(302);
    $this->assertDatabaseHas('keys', $data);
  }

  public function test_destroy_key()
  {
    $user = $this->createTestUser();
    $key = $this->createTestKey();

    $response = $this->actingAs($user)->delete(route('keys.destroy', $key->id));
    // Verifica se houve redirecionamento (status 302)
    $response->assertStatus(302);
    $this->assertDatabaseMissing('keys', ['id' => $key->id]);
  }
}
