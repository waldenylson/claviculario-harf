<?php

namespace Tests\Feature\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserDeletionTest extends TestCase
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
   * Testa a exclusão de um usuário existente.
   */
  public function test_deletes_existing_user()
  {
    $user = $this->createTestUser();
    $userToDelete = $this->createTestUser();

    // Envia a requisição de exclusão via DELETE autenticado
    $response = $this->actingAs($user)->delete(route('usuarios.destroy', $userToDelete->id));

    // Verifica se houve redirecionamento (status 302)
    $response->assertStatus(302);

    // Verifica se o usuário foi removido da base de dados
    $this->assertDatabaseMissing('users', [
      'id' => $userToDelete->id,
    ]);
  }
}
