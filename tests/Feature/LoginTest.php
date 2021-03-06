<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function authenticate()
    {
        $user = User::factory()->create();

        $this->postJson('/api/admin/login', [
            'email' => $user->email,
            'password' => 'password',
        ])
            ->assertSuccessful()
            ->assertJsonStructure(['token', 'expires_in'])
            ->assertJson(['token_type' => 'bearer']);
    }

    /** @test */
    public function fetch_the_current_user()
    {
        $this->actingAs(User::factory()->create())
            ->getJson('/api/admin/user')
            ->assertSuccessful()
            ->assertJsonStructure(['id', 'name', 'email']);
    }

    /** @test */
    public function log_out()
    {
        $token = $this->postJson('/api/admin/login', [
            'email' => User::factory()->create()->email,
            'password' => 'password',
        ])->json()['token'];

        $this->postJson("/api/admin/logout?token=$token")
            ->assertSuccessful();

        $this->getJson("/api/admin/user?token=$token")
            ->assertStatus(401);
    }
}
