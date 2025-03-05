<?php

namespace Tests\Feature\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\HarfStaff;
use App\Models\User;
use App\Models\Department;

class EfetivoDeletionTest extends TestCase
{
  use RefreshDatabase;

  /**
   * Cria um efetivo de teste e retorna-o.
   */
  private function createTestEfetivo(): HarfStaff
  {
    $department = Department::factory()->create();
    return HarfStaff::factory()->create(['department_id' => $department->id]);
  }

  /**
   * Cria um usuário de teste e retorna-o.
   */
  private function createTestUser(): User
  {
    return User::factory()->create();
  }

  /**
   * Testa a exclusão de um efetivo existente.
   */
  public function test_deletes_existing_efetivo()
  {
    $user = $this->createTestUser();
    $efetivo = $this->createTestEfetivo();

    // Envia a requisição de exclusão via DELETE autenticado
    $response = $this->actingAs($user)->delete(route('efetivo.destroy', $efetivo->id));

    // Verifica se houve redirecionamento (status 302)
    $response->assertStatus(302);

    // Verifica se o efetivo foi removido da base de dados
    $this->assertDatabaseMissing('harf_staff', [
      'id' => $efetivo->id,
    ]);
  }
}
