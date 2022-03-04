<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use Tests\TestCase;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected $url = 'api/v1/tenants';

    /**
     * Error Get Products By Tenant
     *
     * @return void
     */
    public function testErrorGetProductsByTenant()
    {
        $tenant = 'fake_value';

        $response = $this->getJson("{$this->url}/{$tenant}/products");

        $response->assertStatus(400);
    }

    /**
     * Get Products By Tenant
     *
     * @return void
     */
    public function testGetProductsByTenant()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("{$this->url}/{$tenant->uuid}/products");

        $response->assertStatus(200);
    }

    /**
     * Error Get Product By Tenant
     *
     * @return void
     */
    public function testErrorGetProductByTenant()
    {
        $tenant = Tenant::factory()->create();
        
        $product = 'fake_value';

        $response = $this->getJson("{$this->url}/{$tenant->uuid}/products/{$product}");

        $response->assertStatus(400);
    }


    /**
     * Get Product By Tenant
     *
     * @return void
     */
    public function testGetProductByTenant()
    {
        $tenant = Tenant::factory()
                        ->has(Product::factory()->count(1))
                        ->create();

        $product = $tenant->products()->first();

        $response = $this->getJson("{$this->url}/{$tenant->uuid}/products/{$product->uuid}");

        $response->assertStatus(200);
    }

}
