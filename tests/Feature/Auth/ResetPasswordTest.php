<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_request_password_reset_link(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $response = $this->postJson('/api/auth/forgot-password', [
            'email' => $user->email,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Link to reset password sent.',
            ]);

        Notification::assertSentTo(
            $user,
            ResetPassword::class
        );
    }

    public function test_email_is_required_to_request_password_reset(): void
    {
        $response = $this->postJson('/api/auth/forgot-password', []);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'email',
            ]);
    }

    public function test_user_can_reset_password_with_valid_token(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('old-password'),
        ]);

        $token = Password::createToken($user);

        $response = $this->postJson('/api/auth/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Senha alterada com sucesso.',
            ]);

        $this->assertTrue(
            Hash::check(
                'new-password',
                $user->fresh()->password
            )
        );
    }

    public function test_user_cannot_reset_password_with_invalid_token(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/auth/reset-password', [
            'token' => 'invalid-token',
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response
            ->assertStatus(422);
    }

    public function test_password_confirmation_must_match(): void
    {
        $user = User::factory()->create();

        $token = Password::createToken($user);

        $response = $this->postJson('/api/auth/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'wrong-confirmation',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'password',
            ]);
    }

    public function test_password_is_required(): void
    {
        $user = User::factory()->create();

        $token = Password::createToken($user);

        $response = $this->postJson('/api/auth/reset-password', [
            'token' => $token,
            'email' => $user->email,
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'password',
            ]);
    }

    public function test_token_is_required(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/auth/reset-password', [
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'token',
            ]);
    }
}