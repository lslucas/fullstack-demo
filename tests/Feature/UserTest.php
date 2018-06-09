<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTest extends TestCase
{
    protected $user;

    protected function setUp()
    {
        parent::setUp();
        $this->user = factory('App\Users\Models\User');
    }

    public function testApiAuthorizationSuccessfull()
    {
        $user = factory(User::class)->create();
        $payload = ['email' => $user->email, 'password' => 'secret'];

        $this->json('POST', 'api/authorize', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'created_at',
                'expires_at'
            ]);
    }

    public function testApiInvalidEmail()
    {
        $payload = ['email' => 'error', 'password' => 'error'];

        $this->json('POST', 'api/authorize', $payload)
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Email doesn\'t exist.'
            ]);
    }

    public function testApiInvalidPassword()
    {
        $payload = ['email' => 'admin@admin.com', 'password' => 'error'];

        $this->json('POST', 'api/authorize', $payload)
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Bad credentials'
            ]);
    }

    public function testCreateUser()
    {
        $user = factory(User::class)->make();

        $payload = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ];

        $q = $this->json('POST', 'register', $payload)
            ->assertStatus(302); //redirect
    }
}
