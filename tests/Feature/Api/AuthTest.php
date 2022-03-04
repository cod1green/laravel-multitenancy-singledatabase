<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Validation Auth
     *
     * @return void
     */
    public function testValidationAuth()
    {
        $payload = [];

        $response = $this->postJson('api/auth/token', $payload);

        $response->assertStatus(422);
    }

    /**
     * Error Auth Client Fake
     *
     * @return void
     */
    public function testErrorAuthClientFake()
    {
        $payload = [
            'email' => 'fake@mail.com.br',
            'password' => '123456789',
            'device_name' => Str::random(10),
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(404)
                    ->assertExactJson([
                        'data' => null,
                        'message' => __('messages.invalid_credentials')
                    ]);
    }

    /**
     * Auth Success
     *
     * @return void
     */
    public function testAuthSuccess()
    {
        $client = Client::factory()->create();

        $payload = [
            'email' => $client->email,
            'password' => 'password',
            'device_name' => Str::random(10),
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(200)
                    ->assertJsonStructure(['data' => ['token']]);
    }

    /**
     * Error Get Auth Me
     *
     * @return void
     */
    public function testErrorGetAuthMe()
    {
        $response = $this->getJson('/api/auth/clients/me');

        $response->assertStatus(401);
    }

    /**
     * Get Auth Me
     *
     * @return void
     */
    public function testGetAuthMe()
    {
        $client = Client::factory()->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->getJson('/api/auth/clients/me', [
            'authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200)
                    ->assertExactJson([
                        'data' => [
                            'name' => $client->name,
                            'email' => $client->email,
                            'identify' => $client->uuid,
                            'phone' => $client->phone,
                            'addresses' => null
                        ]
                    ]);
    }

    /**
     * Get Auth Logout
     *
     * @return void
     */
    public function testGetAuthLogout()
    {
        $client = Client::factory()->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->postJson('/api/auth/clients/logout', [], [
            'authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(204);
    }
}
