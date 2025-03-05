<?php

namespace Tests\Feature\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Department;

class DepartmentDeletionTest extends TestCase
{
  use RefreshDatabase;

  /**
   * Cria um usuário de teste e retorna-o.
   */
  private function createTestUser(): User
  {
    return User::factory()->create();
  }

  /**
   * Cria um departamento de teste e retorna-o.
   */
  private function createTestDepartment(): Department
  {
    return Department::factory()->create();
  }

  /**
   * Testa a exclusão de um departamento existente.
   */
  public function test_deletes_existing_department()
  {
    $user = $this->createTestUser();
    $department = $this->createTestDepartment();

    // Envia a requisição de exclusão via DELETE autenticado
    $response = $this->actingAs($user)->delete(route('departments.destroy', $department->id));

    // Verifica se houve redirecionamento (status 302)
    $response->assertStatus(302);

    // Verifica se o departamento foi removido da base de dados
    $this->assertDatabaseMissing('departments', [
      'id' => $department->id,
    ]);
  }
}
