<?php

namespace Tests\Feature\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Department;

class DepartmentCreationTest extends TestCase
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
   * Testa se a página do formulário é exibida corretamente.
   */
  public function test_form_page_displays_correctly()
  {
    $user = $this->createTestUser();

    $response = $this->actingAs($user)->get(route('departments.create'));
    $response->assertStatus(200);
    $response->assertSee('Cadastrar Nova Seção');
  }

  /**
   * Testa a criação de um novo departamento com dados válidos.
   */
  public function test_creates_a_new_department_with_valid_data()
  {
    $user = $this->createTestUser();

    $data = [
      'name' => 'IT Department',
      'comments' => 'Handles all IT related tasks.',
    ];

    // Envia o formulário via POST autenticado
    $response = $this->actingAs($user)->post(route('departments.store'), $data);

    // Verifica se houve redirecionamento (status 302)
    $response->assertStatus(302);

    // Verifica se o departamento foi inserido na base de dados
    $this->assertDatabaseHas('departments', [
      'name' => 'IT Department',
    ]);
  }

  /**
   * Testa se a validação funciona quando nenhum dado é enviado.
   */
  public function test_fails_to_create_department_with_missing_required_fields()
  {
    $user = $this->createTestUser();

    $data = []; // Nenhum dado enviado

    $response = $this->actingAs($user)->post(route('departments.store'), $data);

    $response->assertSessionHasErrors([
      'name',
    ]);
  }
}
