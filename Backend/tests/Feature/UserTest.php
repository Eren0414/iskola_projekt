<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    private function login(string $email = "test@example.com", string $password = "123")
    {
        //Bejelentkezés
        $response = $this
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->postJson('/api/users/login', [
                'email' => $email,
                'password' => $password
            ]);

        $token = $response->json('data')['token'];
        // dd($token);
        return $token;
    }


    public function test_login()
    {

        $name = 'test99';
        $email = 'test99@example.com';
        $password = '123';

        $user = User::factory()->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        $response = $this
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->postJson('/api/users/login', [
                'email' => $email,
                'password' => $password
            ]);

        $response->assertStatus(200);
        $token = $response->json('data')['token'];
        $this->assertNotNull($token);


        //Egy védett útvonalra küldünk egy kérést
        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ])
            ->get('/api/users');

        // Ellenőrizzük, hogy a kérés sikeres volt-e
        $response->assertStatus(200);
    }

    public function test_create_user(): void
    {

        $token = $this->login();

        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
        ];

        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ])
            ->postJson('/api/users', $data);
        // dd($response);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com']);

        $user = User::where('email', 'johndoe@example.com')->first();
        $this->assertNotNull($user);
    }

    
}
