<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Order;
use App\Models\Client;
use App\Models\FormPayment;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EvaluationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Error Order Invalid Create Evaluation
     *
     * @return void
     */
    public function testErrorOrderInvalidCreateEvaluation()
    {
        $orders = Order::factory()
                        ->count(3)
                        ->for(Tenant::factory()->create())
                        ->for(Client::factory()->create())
                        ->for(FormPayment::factory()->create())
                        ->create();
        
        $order = $orders->first();

        $token = $order->client->createToken(Str::random(10))->plainTextToken;
        
        $identify = 'fake_value';

        $payload =[
            'stars' => 5,
            'comment' => Str::random(10),
        ];

        $headers = [
            'Authorization' => "Bearer {$token}"
        ];

        $response = $this->postJson(
                    "api/v1/orders/{$identify}/evaluations", 
                    $payload, 
                    $headers
        );

        $response->assertStatus(403);
    }

    /**
     * Error Order Valid Create Evaluation Invalid Stars
     *
     * @return void
     */
    public function testErrorValidOrderCreateEvaluationInvalidStars()
    {
        $orders = Order::factory()
                        ->count(3)
                        ->for(Tenant::factory()->create())
                        ->for(Client::factory()->create())
                        ->for(FormPayment::factory()->create())
                        ->create();
        
        $order = $orders->first();

        $token = $order->client->createToken(Str::random(10))->plainTextToken;
        
        $identify = $order->identify;

        $payload =[
            'stars' => 'fake_value',
            'comment' => 'fv',
        ];

        $headers = [
            'Authorization' => "Bearer {$token}"
        ];

        $response = $this->postJson(
                    "api/v1/orders/{$identify}/evaluations", 
                    $payload, 
                    $headers
        );

        $response->assertStatus(422);
    }

    /**
     * Error Create Order Evaluation
     *
     * @return void
     */
    public function testErrorCreateOrderEvaluation()
    {
        $orders = Order::factory()
                        ->count(3)
                        ->for(Tenant::factory()->create())
                        ->for(Client::factory()->create())
                        ->for(FormPayment::factory()->create())
                        ->create();
        
        $order = $orders->first();

        $token = 'fake_value';
        
        $identify = $order->identify;

        $payload =[
            'stars' => 5,
            'comment' => Str::random(10),
        ];

        $headers = [
            'Authorization' => "Bearer {$token}"
        ];

        $response = $this->postJson(
                    "api/v1/orders/{$identify}/evaluations", 
                    $payload, 
                    $headers
        );

        $response->assertStatus(401);
    }

    /**
     * Create Order Evaluation
     *
     * @return void
     */
    public function testCreateOrderEvaluation()
    {
        $orders = Order::factory()
                        ->count(3)
                        ->for(Tenant::factory()->create())
                        ->for(Client::factory()->create())
                        ->for(FormPayment::factory()->create())
                        ->create();
        
        $order = $orders->first();

        $token = $order->client->createToken(Str::random(10))->plainTextToken;
        
        $identify = $order->identify;

        $payload =[
            'stars' => 5,
            'comment' => Str::random(10),
        ];

        $headers = [
            'Authorization' => "Bearer {$token}"
        ];

        $response = $this->postJson(
                    "api/v1/orders/{$identify}/evaluations", 
                    $payload, 
                    $headers
        );

        $response->assertStatus(201);
    }
}
