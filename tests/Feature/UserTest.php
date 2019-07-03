<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use DatabaseMigrations;


    /**
     * @test
     */
    public function user_can_sign_up()
    {
        $credential = [
            "name" => "Oussama ELAMRANI",
            "email" => "oussama1elamrani@gmail.com",
            "password" => "peaceChallenge",
            "password_confirmation" => "peaceChallenge"
        ];

        $res = $this->post('/api/auth/sign-up', $credential);

        $res->assertStatus(201)
            ->assertJson(['message' => 'Successful added !']);

    }

    /**
     * @test
     */
    public function user_cannot_sign_up_with_invalid_data()
    {
        $response = $this->post('/api/auth/sign-up');
        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function user_can_login_with_correct_credentials()
    {
        $user = factory(User::class)->create([
            'password' => $password = 'i-accept-challenge',
        ]);

        $response = $this->post('/api/auth/sign-in',
            [
                'email' => $user->email,
                'password' => $password,
            ]);
        $response->assertStatus(200)
            ->assertJsonStructure(['access_token', 'user', 'expires_at']);
        $this->assertAuthenticatedAs($user);

    }

    /**
     * @test
     */
    public function user_cannot_login_with_wrong_credentials()
    {
        $user = factory(User::class)->create([
            'password' => $password = 'i-accept-challenge',
        ]);

        $response = $this->post('/api/auth/sign-in',
            [
                'email' => $user->email,
                'password' => "{$password} PEACE",
            ]);

        $response->assertStatus(401)->assertJson(['error' => 'Unauthorized']);
    }
}
