<?php

namespace Tests\Feature\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserEditTest extends TestCase
{
    use RefreshDatabase;

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

        $response = $this->actingAs($user)->get(route('usuarios.edit', $user->id));
        $response->assertStatus(200);
        $response->assertSee('Editar Usuário');
    }

    /**
     * Testa a atualização de um usuário com dados válidos.
     */
    public function test_updates_user_with_valid_data()
    {
        $user = $this->createTestUser();

        $data = [
            'military_rank'         => '2S SAD',
            'full_name'             => 'Beltrano de tal',
            'service_name'          => 'B. Beltrano',
            'email'                 => 'email@fab.mil.br',
            'military_unit'         => 'CINDACTA IV - TISI',
            'phone'                 => '(88) 88888-8888',
            'password'              => 'newsecret123',
            'password_confirmation' => 'newsecret123',
            'electronic_signature'  => 'newsecret123',
        ];

        // Envia o formulário via PUT autenticado
        $response = $this->actingAs($user)->put(route('usuarios.update', $user->id), $data);

        // Verifica se houve redirecionamento (status 302)
        $response->assertStatus(302);

        // Verifica se o usuário foi atualizado na base de dados
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'email@fab.mil.br',
        ]);
    }

    /**
     * Testa se a validação funciona quando nenhum dado é enviado.
     */
    public function test_fails_to_update_user_with_missing_required_fields()
    {
        $user = $this->createTestUser();

        $data = []; // Nenhum dado enviado

        $response = $this->actingAs($user)->put(route('usuarios.update', $user->id), $data);

        $response->assertSessionHasErrors([
            'military_rank',
            'full_name',
            'service_name',
            'email',
            'military_unit',
            'phone',
            // 'electronic_signature', -- na edição não é obrigatório
        ]);
    }

    /**
     * Testa se a validação de confirmação de senha está funcionando.
     */
    /* public function test_fails_when_password_confirmation_does_not_match()
    {
        $user = $this->createTestUser();

        $data = [
            'military_rank'         => '2S SAD',
            'full_name'             => 'Beltrano de tal',
            'service_name'          => 'B. Beltrano',
            'email'                 => 'email@fab.mil.br',
            'military_unit'         => 'CINDACTA IV - TISI',
            'phone'                 => '(88) 88888-8888',
            'password'              => 'newsecret123',
            'password_confirmation' => 'diferente',
            'electronic_signature'  => 'newsecret123',
        ];

        $response = $this->actingAs($user)->put(route('usuarios.update', $user->id), $data);

        $response->assertSessionHasErrors('password');
    } */
}
