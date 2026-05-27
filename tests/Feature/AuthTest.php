<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    // Teste de registro
    public function test_user_can_register(): void
    {
        $user = [
            'name' => 'Márcio Silva Meireles de Souza',
            'email' => 'marcio.junior.x6@gmail.com',
            'password' => 'Mari@123456',
            'password_confirmation' => 'Mari@123456',
        ];

        $response = $this->postJson('/api/auth/register', $user);

        $response->assertCreated();
        $response->assertJsonStructure(['token', 'user']);

        $this->assertDatabaseHas('users', [
            'email' => 'marcio.junior.x6@gmail.com',
            'role' => 'user',
        ]);

    }

    public function test_register_requires_name(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => '',
            'email' => 'teste@email.com',
            'password' => 'Senha@123',
            'password_confirmation' => 'Senha@123',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }

    public function test_register_requires_email(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'João Silva',
            'email' => '',
            'password' => 'Senha@123',
            'password_confirmation' => 'Senha@123',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    public function test_register_requires_valid_email(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'João Silva',
            'email' => 'email-invalido',
            'password' => 'Senha@123',
            'password_confirmation' => 'Senha@123',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    public function test_register_requires_unique_email(): void
    {
        User::factory()->create([
            'email' => 'teste@email.com',
        ]);

        $response = $this->postJson('/api/auth/register', [
            'name' => 'João Silva',
            'email' => 'teste@email.com',
            'password' => 'Senha@123',
            'password_confirmation' => 'Senha@123',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    public function test_register_requires_password(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'João Silva',
            'email' => 'teste@email.com',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('password');
    }

    public function test_register_requires_password_with_minimum_8_characters(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'João Silva',
            'email' => 'teste@email.com',
            'password' => '1234567',
            'password_confirmation' => '1234567',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('password');
    }

    public function test_register_requires_password_confirmation(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'João Silva',
            'email' => 'teste@email.com',
            'password' => 'Senha@123',
            'password_confirmation' => 'OutraSenha',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('password');
    }

    public function test_register_requires_name_max_255_characters(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => str_repeat('a', 256),
            'email' => 'teste@email.com',
            'password' => 'Senha@123',
            'password_confirmation' => 'Senha@123',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }

    // Testes de login
    public function test_user_can_login(): void
    {
        // preparar
        $user = User::factory()->create();

        // Executar
        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]
        );

        // validar
        $response->assertOk();
    }

    public function test_login_requires_email(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => '',
            'password' => 'password',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    public function test_login_requires_valid_email(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'email-invalido',
            'password' => 'password',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    public function test_login_requires_password(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'teste@email.com',
            'password' => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('password');
    }

    public function test_login_fails_with_nonexistent_email(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'naoexiste@email.com',
            'password' => 'password',
        ]);

        $response->assertUnprocessable();
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'senha-incorreta',
        ]);

        $response->assertUnprocessable();
    }
}
