<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Order;
use App\Models\Table;
use App\Models\Client;
use App\Models\Coupon;
use App\Models\FormPayment;
use App\Models\Tenant;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
   use RefreshDatabase;

    protected $url = 'api/v1/tenants';

    /**
     * Error Get Order By Tenant Invalid
     *
     * @return void
     */
    public function testErrorGetOrderByTenantInvalid()
    {
        $tenant = 'fake_value';

        $payload = [];

        $response = $this->postJson("{$this->url}/{$tenant}/orders", $payload);

        $response->assertStatus(404);
    }

    /**
     * Error Create Order By Tenant Valid
     *
     * @return void
     */
    public function testErrorCreateOrderByTenantValid()
    {
        $tenant = Tenant::factory()->create();

        $payload = [];

        $response = $this->postJson("{$this->url}/{$tenant->uuid}/orders", $payload);

        $response->assertStatus(422)
                    ->assertJsonPath('errors.products', [
                        __('validation.required', ['attribute' => 'produtos'])
                    ]);
    }

    /**
     * Error Create Order With Table By Tenant
     *
     * @return void
     */
    public function testErrorCreateOrderWithTableByTenant()
    {
        $tenant = Tenant::factory()
                        ->has(Product::factory()->count(10))
                        ->create();

        $products = $tenant->products()->get();

        $payload = [
            'products' => [],
            'table' => 'fake_value',
            'comment' => 'Um comentário',
            'address' => 'Teste de endereço',
        ];
        foreach($products as $product) {
            array_push($payload['products'],[
                'identify' => $product->uuid,
                'qty' => 2,
            ]);
        }

        $response = $this->postJson("{$this->url}/{$tenant->uuid}/orders", $payload);

        $response->assertStatus(422)
        ->assertJsonPath('errors.table', [
            __('validation.exists', ['attribute' => 'mesa' ])
        ]);
    }

    /**
     * Create Order By Tenant
     *
     * @return void
     */
    public function testCreateOrderByTenant()
    {
        $tenant = Tenant::factory()
                        ->has(Product::factory()->count(10))
                        ->has(FormPayment::factory()->count(1))
                        ->create();

        $products = $tenant->products()->get();

        $payload = [
            'address' => 'Teste de endereço',
            'shipping' => 0.00,
            'products' => [],
            'form_payment_id' => $tenant->formPayments()->first()->id,
        ];
        foreach($products as $product) {
            array_push($payload['products'],[
                'identify' => $product->uuid,
                'qty' => 2,
            ]);
        }

        $response = $this->postJson("{$this->url}/{$tenant->uuid}/orders", $payload);

        // $response->dump();

        $response->assertStatus(201);
    }

    /**
     * Create Order With Table By Tenant
     *
     * @return void
     */
    public function testCreateOrderWithTableByTenant()
    {
        $tenant = Tenant::factory()
                        ->has(Product::factory()->count(10))
                        ->has(Table::factory()->count(1))
                        ->has(FormPayment::factory()->count(3))
                        ->create();

        $products = $tenant->products()->get();
        $table = $tenant->tables()->first();

        $payload = [
            'products' => [],
            'table' => $table->uuid,
            'shipping' => 0.00,
            'comment' => 'Um comentário',
            'address' => 'Teste de endereço',
            'form_payment_id' => $tenant->formPayments()->first()->id
        ];
        foreach($products as $product) {
            array_push($payload['products'],[
                'identify' => $product->uuid,
                'qty' => 2,
            ]);
        }

        $response = $this->postJson("{$this->url}/{$tenant->uuid}/orders", $payload);

        $response->assertStatus(201);
    }

    /**
     * Total Order By Tenant
     *
     * @return void
     */
    public function testTotalOrderByTenant()
    {
        $tenant = Tenant::factory()
                        ->has(Product::factory()->count(2))
                        ->has(FormPayment::factory()->count(2))
                        ->create();

        $products = $tenant->products()->get();

        $payload = [
            'address' => 'Teste de endereço',
            'shipping' => 0.00,
            'products' => [],
            'form_payment_id' => $tenant->formPayments()->first()->id
        ];
        foreach($products as $product) {
            array_push($payload['products'],[
                'identify' => $product->uuid,
                'qty' => 2,
            ]);
        }

        $response = $this->postJson("{$this->url}/{$tenant->uuid}/orders", $payload);

        $response->assertStatus(201)
                    ->assertJsonPath('data.total', 51.6);
    }

    /**
     * Error Order By Tenant
     *
     * @return void
     */
    public function testErrorOrderByTenant()
    {
        $uuid = 'fake_value';
        $identify = 'fake_value';

        $response = $this->getJson("api/v1/orders/{$identify}");

        $response->assertStatus(404);
    }

    /**
     * Error Order By Tenant Invalid
     *
     * @return void
     */
    public function testErrorOrderByTenantInvalid()
    {
        $order = Order::factory()->create();

        $uuid = 'fake_value';
        $identify = $order->uuid;

        $response = $this->getJson("api/v1/orders/{$identify}");

        $response->assertStatus(404);
    }

    /**
     * Error Order By Tenant Valid
     *
     * @return void
     */
    public function testErrorOrderByTenantValid()
    {
        $tenant = Tenant::factory()->create();

        $uuid = $tenant->uuid;
        $identify = "fake_value";

        $response = $this->getJson("api/v1/orders/{$identify}");

        $response->assertStatus(404);
    }

    /**
     * Get Order By Tenant
     *
     * @return void
     */
    public function testGetOrderByTenant()
    {
        $tenant = Tenant::factory()
                            ->has(Order::factory()->count(1))
                            ->create();

        $identify = $tenant->orders()->first()->identify;

        $response = $this->getJson("api/v1/orders/{$identify}");

        // $response->dump();

        $response->assertStatus(200);
    }

    /**
     * Create Order Authenticated
     *
     * @return void
     */
    public function testCreateOrderAuthenticated()
    {
        $client = Client::factory()->create();

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $tenant = Tenant::factory()
                            ->has(Product::factory()->count(10))
                            ->has(Table::factory()->count(3))
                            ->has(FormPayment::factory()->count(3))
                            ->create();

        $uuidTenant = $tenant->uuid;
        $products = $tenant->products()->get();

        $payload = [
            'address' => 'Teste de endereço',
            'shipping' => 0.00,
            'products' => [],
            'table' => $tenant->tables()->first()->uuid,
            'form_payment_id' => $tenant->formPayments()->first()->id
        ];

        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 1,
            ]);
        }

        $response = $this->postJson("/api/auth/tenants/{$uuidTenant}/orders", $payload, [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(201);
    }

    /**
     * Create Order Coupon Authenticated
     *
     * @return void
     */
    public function testCreateOrderCouponAuthenticated()
    {
        $client = Client::factory()->create();

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $tenant = Tenant::factory()
                            ->has(Product::factory()->count(10))
                            ->has(Table::factory()->count(3))
                            ->has(FormPayment::factory()->count(3))
                            ->create();

        $uuidTenant = $tenant->uuid;
        $products = $tenant->products()->get();
        $coupon = Coupon::factory()->create();

        $payload = [
            'address' => 'Teste de endereço',
            'shipping' => 0.00,
            'products' => [],
            'table' => $tenant->tables()->first()->uuid,
            'form_payment_id' => $tenant->formPayments()->first()->id,
            'total'
        ];

        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 1,
            ]);
        }

        $response = $this->postJson("/api/auth/tenants/{$uuidTenant}/orders", $payload, [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(201);
    }

    /**
     * Get My Orders
     *
     * @return void
     */
    public function testGetMyOrders()
    {
        // $client = Client::factory()->create();

        $orders = Order::factory()
                            ->count(15)
                            ->for(Tenant::factory()->create())
                            ->for(Client::factory()->create())
                            ->for(FormPayment::factory()->create())
                            ->create();

        $client = $orders->first()->client;

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->getJson("/api/v1/clients/my-orders", [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200)
                    ->assertJsonCount(15, 'data');
    }
}
