<?php

namespace Tests\Feature\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\HarfStaff;
use App\Models\Department;
use App\Models\User;

class EfetivoEditTest extends TestCase
{
  use RefreshDatabase;

  /**
   * Cria um efetivo de teste e retorna-o.
   */
  private function createTestEfetivo()
  {
    $department = Department::factory()->create();
    return HarfStaff::factory()->create(['department_id' => $department->id]);
  }

  /**
   * Cria um usuário de teste e retorna-o.
   */
  private function createTestUser()
  {
    return User::factory()->create();
  }

  /**
   * Testa se a página de edição é exibida corretamente.
   */
  public function test_edit_page_displays_correctly()
  {
    $user = $this->createTestUser();
    $efetivo = $this->createTestEfetivo();

    $response = $this->actingAs($user)->get(route('efetivo.edit', $efetivo->id));
    $response->assertStatus(200);
    $response->assertSee('Editar Usuário do Efetivo');
  }

  /**
   * Testa a atualização de um efetivo com dados válidos.
   */
  public function test_updates_efetivo_with_valid_data()
  {
    $user = $this->createTestUser();
    $efetivo = $this->createTestEfetivo();

    $data = [
      'name'                 => 'Beltrano de tal',
      'email'                => 'email@fab.mil.br',
      'phone'                => '(88) 88888-8888',
      'extension'            => '1234',
      'department_id'        => $efetivo->department_id,
      'military'             => true,
      'electronic_signature' => '123456',
    ];

    // Envia o formulário via PUT autenticado
    $response = $this->actingAs($user)->put(route('efetivo.update', $efetivo->id), $data);

    // Verifica se houve redirecionamento (status 302)
    $response->assertStatus(302);

    // Verifica se o efetivo foi atualizado na base de dados
    $this->assertDatabaseHas('harf_staff', [
      'id' => $efetivo->id,
      'email' => 'email@fab.mil.br',
    ]);
  }

  /**
   * Testa se a validação funciona quando nenhum dado é enviado.
   */
  public function test_fails_to_update_efetivo_with_missing_required_fields()
  {
    $user = $this->createTestUser();
    $efetivo = $this->createTestEfetivo();

    $data = []; // Nenhum dado enviado

    $response = $this->actingAs($user)->put(route('efetivo.update', $efetivo->id), $data);

    $response->assertSessionHasErrors([
      'name',
      'phone',
      'department_id',
      'military',
      // 'electronic_signature', -- na edição não é obrigatório
    ]);
  }

  /**
   * Testa se a validação de confirmação de senha está funcionando.
   */
  public function test_fails_when_electronic_signature_is_invalid()
  {
    $user = $this->createTestUser();
    $efetivo = $this->createTestEfetivo();

    $data = [
      'name'                 => 'Beltrano de tal',
      'email'                => 'email@fab.mil.br',
      'phone'                => '(88) 88888-8888',
      'extension'            => '1234',
      'department_id'        => $efetivo->department_id,
      'military'             => true,
      'electronic_signature' => '123', // Assinatura eletrônica inválida
    ];

    $response = $this->actingAs($user)->put(route('efetivo.update', $efetivo->id), $data);

    $response->assertSessionHasErrors('electronic_signature');
  }
}
