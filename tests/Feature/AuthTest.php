<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function testLogin() {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('123123'),
        ]);

        $response = $this->postJson('/api/auth/login', [
                'email' => $user->email,
                'password' => '123123'
            ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                "status" => "success",
                "code" => 200,
                "data" => [
                    "user" => [],
                    "expires_in" => 60,
                    "token_type" => "bearer"
                ],
                "message" => null
            ]);
    }

    public function testRegister()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'test2',
            'email' => 'test2@gmail.com',
            'password' => '123123',
        ]);
        $response->assertStatus(201);
    }

}
