<?php

namespace Tests\Feature\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Department;

class DepartmentEditTest extends TestCase
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
   * Testa se a página de edição é exibida corretamente.
   */
  public function test_edit_page_displays_correctly()
  {
    $user = $this->createTestUser();
    $department = $this->createTestDepartment();

    $response = $this->actingAs($user)->get(route('departments.edit', $department->id));
    $response->assertStatus(200);
    $response->assertSee('Editar Seção');
  }

  /**
   * Testa a atualização de um departamento com dados válidos.
   */
  public function test_updates_department_with_valid_data()
  {
    $user = $this->createTestUser();
    $department = $this->createTestDepartment();

    $data = [
      'name' => 'Updated Department',
      'comments' => 'Updated comments.',
    ];

    // Envia o formulário via PUT autenticado
    $response = $this->actingAs($user)->put(route('departments.update', $department->id), $data);

    // Verifica se houve redirecionamento (status 302)
    $response->assertStatus(302);

    // Verifica se o departamento foi atualizado na base de dados
    $this->assertDatabaseHas('departments', [
      'id' => $department->id,
      'name' => 'Updated Department',
    ]);
  }

  /**
   * Testa se a validação funciona quando nenhum dado é enviado.
   */
  public function test_fails_to_update_department_with_missing_required_fields()
  {
    $user = $this->createTestUser();
    $department = $this->createTestDepartment();

    $data = []; // Nenhum dado enviado

    $response = $this->actingAs($user)->put(route('departments.update', $department->id), $data);

    $response->assertSessionHasErrors([
      'name',
    ]);
  }
}
