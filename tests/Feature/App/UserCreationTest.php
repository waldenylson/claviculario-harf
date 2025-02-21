<?php

namespace Tests\Feature\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserCreationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Cria um usuário de teste e retorna-o.
     */
    private function createTestUser(): User
    {
        return User::factory()->create()->first();
    }

    /**
     * Testa se a página do formulário é exibida corretamente.
     * (A rota /usuarios/novo deve ser ajustada para a rota que exibe o formulário)
     */
    public function test_form_page_displays_correctly()
    {
        $user = $this->createTestUser();

        $response = $this->actingAs($user)->get('/usuarios/novo');
        $response->assertStatus(200);
        $response->assertSee('Criar Novo Usuário do Sistema');
    }

    /**
     * Testa a criação de um novo usuário com dados válidos.
     */
    public function test_creates_a_new_user_with_valid_data()
    {
        $user = $this->createTestUser();

        $data = [
            'military_rank'         => '1S SAD',
            'full_name'             => 'Fulano de tal',
            'service_name'          => 'J. Fulano',
            'email'                 => 'email@fab.mil.br',
            'military_unit'         => 'CINDACTA III - TISI',
            'phone'                 => '(99) 99999-9999',
            'password'              => 'secret123',
            'password_confirmation' => 'secret123',
            'electronic_signature'  => 'secret123',
        ];

        // Envia o formulário via POST autenticado
        $response = $this->actingAs($user)->post('/usuarios/salvar', $data);

        // Verifica se houve redirecionamento (status 302)
        $response->assertStatus(302);

        // Verifica se o usuário foi inserido na base de dados
        $this->assertDatabaseHas('users', [
            'email' => 'email@fab.mil.br',
        ]);
    }

    /**
     * Testa se a validação funciona quando nenhum dado é enviado.
     */
    public function test_fails_to_create_user_with_missing_required_fields()
    {
        $user = $this->createTestUser();

        $data = []; // Nenhum dado enviado

        $response = $this->actingAs($user)->post('/usuarios/salvar', $data);

        $response->assertSessionHasErrors([
            'military_rank',
            'full_name',
            'service_name',
            'email',
            'military_unit',
            'phone',
            'password',
            'electronic_signature',
        ]);
    }

    /**
     * Testa se a validação de confirmação de senha está funcionando.
     */
    public function test_fails_when_password_confirmation_does_not_match()
    {
        $user = $this->createTestUser();

        $data = [
            'military_rank'         => '1S SAD',
            'full_name'             => 'Fulano de tal',
            'service_name'          => 'J. Fulano',
            'email'                 => 'email@fab.mil.br',
            'military_unit'         => 'CINDACTA III - TISI',
            'phone'                 => '(99) 99999-9999',
            'password'              => 'secret123',
            'password_confirmation' => 'diferente',
            'electronic_signature'  => 'secret123',
        ];

        $response = $this->actingAs($user)->post('/usuarios/salvar', $data);

        $response->assertSessionHasErrors('password');
    }
}
