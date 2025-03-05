<?php

namespace Tests\Feature\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\HarfStaff;
use App\Models\User;
use App\Models\Department;

class EfetivoCreationTest extends TestCase
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
   * (A rota /efetivo/novo deve ser ajustada para a rota que exibe o formulário)
   */
  public function test_form_page_displays_correctly()
  {
    $user = $this->createTestUser();

    $response = $this->actingAs($user)->get('/efetivo/novo');
    $response->assertStatus(200);
    $response->assertSee('Criar Novo Usuário do Efetivo');
  }

  /**
   * Testa a criação de um novo efetivo com dados válidos.
   */
  public function test_creates_a_new_efetivo_with_valid_data()
  {
    $user = $this->createTestUser();
    $department = Department::factory()->create();

    $data = [
      'name'                 => 'Fulano de tal',
      'email'                => 'email@fab.mil.br',
      'phone'                => '(99) 99999-9999',
      'extension'            => '1234',
      'department_id'        => $department->id,
      'military'             => 1,
      'electronic_signature' => '123123',
    ];


    // Envia o formulário via POST autenticado
    $response = $this->actingAs($user)->post('/efetivo/salvar', $data);


    // Verifica se houve redirecionamento (status 302)
    $response->assertStatus(302);

    // Verifica se o efetivo foi inserido na base de dados
    $this->assertDatabaseHas('harf_staff', [
      'email' => 'email@fab.mil.br',
    ]);
  }

  /**
   * Testa se a validação funciona quando nenhum dado é enviado.
   */
  public function test_fails_to_create_efetivo_with_missing_required_fields()
  {
    $user = $this->createTestUser();

    $data = []; // Nenhum dado enviado

    $response = $this->actingAs($user)->post('/efetivo/salvar', $data);

    $response->assertSessionHasErrors([
      'name',
      'phone',
      'department_id',
      'military',
      'electronic_signature',
    ]);
  }

  /**
   * Testa se a validação de confirmação de assinatura eletrônica está funcionando.
   */
  public function test_fails_when_electronic_signature_is_invalid()
  {
    $user = $this->createTestUser();
    $department = Department::factory()->create();

    $data = [
      'name'                 => 'Fulano de tal',
      'email'                => 'email@fab.mil.br',
      'phone'                => '(99) 99999-9999',
      'extension'            => '1234',
      'department_id'        => $department->id,
      'military'             => true,
      'electronic_signature' => '123', // Assinatura eletrônica inválida
    ];

    $response = $this->actingAs($user)->post('/efetivo/salvar', $data);

    $response->assertSessionHasErrors('electronic_signature');
  }
}
