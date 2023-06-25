<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_logins_returns_token_with_valid_credentials(): void
    {
        $user = User::factory()->create();
        $response = $this->postJson('api/v1/login', [
            'email' => $user->email,
            'password' => 'root'

        ]);
        
        $response->assertStatus(200);
        $response->assertJsonStructure(['access_token']);
    }

    public function test_logins_returns_error_with_invalid_credentials(): void
    {
        $response = $this->postJson('api/v1/login', [
            'email' => 'haipo@gmail.com',
            'password' => 'root'

        ]);
        
        $response->assertStatus(422);
    }
}
